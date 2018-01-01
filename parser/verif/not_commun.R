n <- read.table("a.txt",stringsAsFactors=F)
m <- read.table("b.txt",stringsAsFactors=F)

a <- n[,1]
b <- m[,1]

la=length(a)
lb=length(b)


i=1
k=1
while (k <= d) {
	f=TRUE
	j=1
	while (j <= da && f) {
		if (b[i] == a[j]) {
			f=FALSE
			b=b[-i]
			i=i-1
		}
		j=j+1
	}
	k=k+1
	i=i+1
}
