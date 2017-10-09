xuypizda = input()
a = input()
b = input()
c = input()
d = input()
a = a.replace(" ", "")
b = b.replace(" ", "")
c = c.replace(" ", "")
d = d.replace(" ", "")
a1 = len(a)
b1 = len(b)
c1 = len(c)
d1 = len(d)
x = 0
if a[a1-1] == b[b1-1] and a[a1-2] == b[b1-2] and c[c1-1] == d[d1-1] and c[c1-2] == d[d1-2]:
	x = 1

if a[a1-1] ==  c[c1-1] and a[a1-2] ==  c[c1-2] and b[b1-1] == d[d1-1] and b[b1-2] == d[d1-2] and x == 0:
	x = 1

if a[a1-1] ==  d[d1-1] and a[a1-2] ==  d[d1-2] and b[b1-1] == c[c1-1] and b[b1-2] == c[c1-2] and x == 0:
	x = 1
if x == 1:
	print('Yes')
else:
	print('No')