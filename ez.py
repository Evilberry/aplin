key = input()
i = 0
x = 0
while i < 6:
	if key[i].isdigit():
		if i == 0 or i > 3:
			x = 1
			print('NO')
			break
	if i > 0 and i < 3:
		if key[i].isdigit() == False:
			x = 1
			print('NO')
			break
	i+=1
if x == 0:
	print('YES')