com = read.csv("comment.csv",stringsAsFactors=F)
coln=colnames(com)

n=dim(com)[1]
dup=c()

for (i in seq(1,n-1,1)) {
	for (j in seq(i+1,n,1)) {
		a=gsub("\\s", "", com[i,2])
		b=gsub("\\s", "", com[j,2])
		if(a==b) {
			a=gsub("\\s", "", com[i,3])
			b=gsub("\\s", "", com[j,3])
			if(a==b) {
				dup <- c(dup,j)
			}
		}
	}
}

dup2=unique(dup)
com2=com[-dup2,]
colnames(com2)=coln
write.csv(com2,"commentOK.csv",row.names=T)
