#!/usr/bin/env python2

import re, sys, csv

#-----------------------------------------------------------------------
# FONCTION DE PARSING DU FICHIER db_enzyme.txt
#-----------------------------------------------------------------------
def parse_db(infile, parser) :
	try:
		f = open(infile, "r")
		lines = f.readlines()
		f.close()
	except:
		print("Erreur chargement fichier "+infile)
		sys.exit(0)

	for l in lines :
		enzyme = tuple(re.split("\.",re.split("<EC>EC (.*)</EC>",l)[1]))
		parser["enz"].append(enzyme)
		parser[enzyme] = dict()
		parser[enzyme]['S_NAME'] = re.split("<S_NAME>(.*)</S_NAME>",l)[1]
		parser[enzyme]['O_NAME'] = filter(None,re.split("\.",re.split("<O_NAME>(.*)</O_NAME>",l)[1]))
		#~ parser[enzyme]['ACTIVITY'] = filter(None,re.split("\.",re.split("<ACTIVITY>(.*)</ACTIVITY>",l)[1]))
		parser[enzyme]['ACTIVITY'] = re.split("<ACTIVITY>(.*)</ACTIVITY>",l)[1]
		parser[enzyme]['COFACTORS'] = re.split("<COFACTORS>(.*)</COFACTORS>",l)[1]
		parser[enzyme]['COMMENTS'] = re.split("<COMMENTS>(.*)</COMMENTS>",l)[1]
		parser[enzyme]['DISEASE'] = re.split("<DISEASE>(.*)</DISEASE>",l)[1]
		parser[enzyme]['PROSITE'] = filter(None,re.split(";",re.split("<PROSITE>(.*)</PROSITE>",l)[1]))
		parser[enzyme]['SWISSPROT'] = filter(None,re.split(";",re.split("<SWISSPROT>(.*)</SWISSPROT>",l)[1]))
	return parser
	


#-----------------------------------------------------------------------
# FONCTION DE PARSING DU FICHIER intenz.txt
#-----------------------------------------------------------------------
def parse_int(infile,parser) :
	try:
		f = open(infile, "r")
		lines = f.readlines()
		f.close()
	except:
		print("Erreur chargement fichier "+infile)
		sys.exit(0)

	# liste des balises :
	# ['ec', 'accepted_name', 'systematic_name', 'synonym', 'comment', 'authors', 'title', 'year', 'volume', 'first_page', 'last_page', 'edition', 'editor', 'pubmed', 'medline', 'history', 'transferred', 'deleted']
	
	exp = "<(.+)>(.*)</(.+)>"

	for l in lines :
		elements = re.split("\t",l)[1:] # un element est une ligne. Liste qui contient chaque balise + valeur
		n = len(elements) # nombre de balise par ligne (ie nombre de champ pour chaque enzyme)
		
		x = filter(None,re.split(exp,elements[0]))
		if(x[0] == x[2]) :
			if(x[0] == "ec") :
				enzyme = tuple(re.split("EC (.*)\.(.*)\.(.*)\.(.*)",x[1])[1:5])
			else :
				print "Erreur fichier : une ligne ne commence pas par l'identifiant de l'enzyme"
				sys.exit(0)
		
		if (enzyme not in parser["enz"]) :
			parser["enz"].append(enzyme)
			parser[enzyme] = dict()
			print "Attention l'enzyme "+enzyme+" n'etait present que dans un seul fichier"
		
		
		# Creation des listes
		parser[enzyme]["synonym"] = list()
		parser[enzyme]["comment"] = list()
		parser[enzyme]["authors"] = list()
		parser[enzyme]["title"] = list()
		parser[enzyme]["year"] = list()
		parser[enzyme]["volume"] = list()
		parser[enzyme]["first_page"] = list()
		parser[enzyme]["last_page"] = list()
		parser[enzyme]["editorial place"] = list()
		parser[enzyme]["edition"] = list()
		parser[enzyme]["editor"] = list()
		parser[enzyme]["pubmed"] = list()
		parser[enzyme]["medline"] = list()

		i = 1
		j = -1

		while (i < n) :
			x = filter(None,re.split(exp,elements[i]))
			
			# cas particulier : 'deleted'
			if re.search("deleted", x[0]) :
				deletion_note = re.split("<note>(.*)</note",x[0])
				if (len(deletion_note) > 1) :
					parser[enzyme]["deletion_note"] = deletion_note[1]
				i+=1
			
			# cas particulier : 'transferred'
			elif re.search("transferred", x[0]) :
				transfert_note = re.split("<note>(.*)</note",x[0])
				if (len(transfert_note) > 1) :
					parser[enzyme]["transfert_note"] = transfert_note[1]
				
			# cas particulier : 'synonym'
			elif (x[0] == "synonym") :
				parser[enzyme]["synonym"].append(x[1])
			
			# cas particulier : 'comments'
			elif (x[0] == "comment") :
				parser[enzyme]["comment"].append(x[1])
			
			# cas particulier : litterature
			elif (x[0] == "authors") :
				parser[enzyme]["authors"].append(x[1])
				parser[enzyme]["title"].append("NULL")
				parser[enzyme]["year"].append("NULL")
				parser[enzyme]["volume"].append("NULL")
				parser[enzyme]["first_page"].append("NULL")
				parser[enzyme]["last_page"].append("NULL")
				parser[enzyme]["editorial place"].append(["NULL","NULL"])
				parser[enzyme]["edition"].append("NULL")
				parser[enzyme]["editor"].append("NULL")
				parser[enzyme]["pubmed"].append("NULL")
				parser[enzyme]["medline"].append("NULL")
				j+=1
				
			elif (x[0] == "title") :
				parser[enzyme]["title"][j] = x[1]
			
			elif (x[0] == "year") :
				parser[enzyme]["year"][j] = x[1]
				
			elif (x[0] == "volume") :
				parser[enzyme]["volume"][j] = x[1]
						
			elif (x[0] == "first_page") :
				parser[enzyme]["first_page"][j] = x[1]
			
			elif (x[0] == "last_page") :
				parser[enzyme]["last_page"][j] = x[1]
							
			elif re.search("editorial place", x[0]) :
				place = re.split("editorial place=\"(.*)\"",x[0])[1]
				parser[enzyme]["editorial place"][j] = [place,x[1]]
			
			elif(x[0] == "edition") :
				parser[enzyme]["edition"][j] = x[1]
					
			elif(x[0] == "editor") :
				parser[enzyme]["editor"][j] = x[1]
			
			elif(x[0] == "pubmed") :
				parser[enzyme]["pubmed"][j] = x[1]
			
			elif(x[0] == "medline") :
				parser[enzyme]["medline"][j] = x[1]
			
			# tous les autres cas			
			elif (x[0] in ['accepted_name', 'systematic_name', 'history']) :
				parser[enzyme][x[0]] = x[1]
			i+=1
	return parser


#---------------------------------------
# FONCTION ECRITURE DES RESULTATS
#---------------------------------------

def writecsv(d_ec) :
	
	id_enz = 0
	id_art = 0
	id_syn = 0
	id_pro = 0
	id_swi = 0
	id_com = 0
	id_note = 0
	
	enzf = csv.writer(open("enzyme.csv", "wb"))
	enzf.writerow(["id_enzyme","ec1","ec2","ec3","ec4","accepted_name,","systematic_name","cofactors","activity","history"])
	
	notef = csv.writer(open("note.csv", "wb"))
	notef.writerow(["id_note","type","note","id_enzyme"])
	
	publief = csv.writer(open("publie.csv", "wb"))
	publief.writerow(["id_enzyme","id_article"])
	
	articlef = csv.writer(open("article.csv", "wb"))
	articlef.writerow(["id_article","authors","title","year","volume","first_page","last_page","pubmed","medline"])
	
	editionf = csv.writer(open("edition.csv", "wb"))
	editionf.writerow(["id_article","editorial_place","city","edition","editor"])
	
	prositef = csv.writer(open("prosite.csv", "wb"))
	prositef.writerow(["id_prosite","num_prosite","id_enzyme"])
	
	swissprotf = csv.writer(open("swissprot.csv", "wb"))
	swissprotf.writerow(["id_swissport","num_swissprot","code_swissprot","id_enzyme"])
	
	commentf = csv.writer(open("comment.csv", "wb"))
	commentf.writerow(["id_com","comment","id_enz"])
	
	synonymf = csv.writer(open("synonym.csv", "wb"))
	synonymf.writerow(["id_syn","synonyme","id_enzyme"])
	
	for e in d_ec["enz"] :
		id_enz += 1
		
		#TABLE ENZYME
		if d_ec[e]['S_NAME'] == "" :
			d_ec[e]['S_NAME'] = "NULL"
		if d_ec[e]['COFACTORS'] == "" :
			d_ec[e]['COFACTORS'] = "NULL"
		if d_ec[e]['ACTIVITY'] == "" :
			d_ec[e]['ACTIVITY'] = "NULL"
		if not "accepted_name" in d_ec[e] :
			d_ec[e]["accepted_name"] = "NULL"
		if not "systematic_name" in d_ec[e] :
			d_ec[e]["systematic_name"] = "NULL"
		if not "history" in d_ec[e] :
			d_ec[e]["history"] = "NULL"
		enzf.writerow([str(id_enz),e[0],e[1],e[2],e[3],d_ec[e]["accepted_name"],d_ec[e]["systematic_name"],d_ec[e]["COFACTORS"],d_ec[e]["ACTIVITY"],d_ec[e]["history"]])
		
		#TABLE NOTE
		if "transfert_note" in d_ec[e] :
			id_note += 1
			notef.writerow([str(id_note),"transfered",d_ec[e]["transfert_note"],str(id_enz)])
		elif "deletion_note" in d_ec[e] :
			id_note += 1
			notef.writerow([str(id_note),"deleted",d_ec[e]["deletion_note"],str(id_enz)])
					
		#TABLES ARTICLE, PUBLIE ET EDITION
		if "authors" in d_ec[e] :			
			for i in range(len(d_ec[e]["authors"])) :
				id_art += 1

				publief.writerow([str(id_enz),str(id_art)])
				articlef.writerow([str(id_art),d_ec[e]["authors"][i],d_ec[e]["title"][i],str(d_ec[e]["year"][i]),str(d_ec[e]["volume"][i]),str(d_ec[e]["first_page"][i]),str(d_ec[e]["last_page"][i]),str(d_ec[e]["pubmed"][i]),str(d_ec[e]["medline"][i])])
				
				if (d_ec[e]["edition"]) :
					if (d_ec[e]["edition"][i] != "NULL") :
						editionf.writerow([str(id_art),d_ec[e]["editorial place"][i][1],d_ec[e]["editorial place"][i][0],d_ec[e]["edition"][i],d_ec[e]["editor"][i]])

		#TABLE PROSITE
		if d_ec[e]['PROSITE'] != "" :
			for i in range(len(d_ec[e]['PROSITE'])) :
				id_pro += 1
				prositef.writerow([str(id_pro),d_ec[e]['PROSITE'][i],str(id_enz)])
		
		#TABLE SWISSPROT
		if d_ec[e]['SWISSPROT'] != "" :
			for i in range(len(d_ec[e]['SWISSPROT'])) :
				id_swi += 1
				s = re.split(",",d_ec[e]['SWISSPROT'][i])
				swissprotf.writerow([str(id_swi),s[0],s[1],str(id_enz)])

		#TABLE SYNONYME
		c=0
		if d_ec[e]['O_NAME'] != "" :
			c+=1
		if "synonym" in d_ec:
			c+=2
		
		if c>0 :
			if c==3 :
				sy = d_ec['synomyn'].append(d_ec[e]['O_NAME'])
			elif c==2 :
				sy = d_ec['synonym']
			elif c==1 :
				sy = d_ec[e]['O_NAME']
			for i in range(len(sy)) :
				id_syn += 1
				synonymf.writerow([str(id_syn),sy[i],str(id_enz)])
				
		#TABLE COMMENTS
		c=0
		if d_ec[e]['COMMENTS'] != "" :
			c+=1
		if 'comment' in d_ec[e]:
			c+=2
		
		if c>0 :
			if c==3 :
				com = d_ec[e]['comment']
				com.append(d_ec[e]['COMMENTS'])
			elif c==2 :
				com = d_ec[e]['comment']
			elif c==1 :
				com = list(d_ec[e]['COMMENTS'])

			for i in range(len(com)) :
				id_com += 1
				commentf.writerow([str(id_com),com[i],str(id_enz)])

#-----------------------------------------------------------------------
# FONCTION DE PARSING
#-----------------------------------------------------------------------
def parser(in1, in2) :
	
	parser = dict()
	parser["enz"] = list()
	return parse_int(in_int, parse_db(in_db, parser))

#-----------------------------------------------------------------------
# MAIN
#-----------------------------------------------------------------------
if __name__ == "__main__":
	in_db = "db_enzyme.txt"
	in_int = "intenz.txt"	
	d_ec = parser(in_db, in_int)

	writecsv(d_ec)
