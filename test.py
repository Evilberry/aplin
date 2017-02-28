n = input('Enter n>=3: ')
m = input('Enter m<=50: ')
n = int(n)
m = int(m)
i = 1
x = 0
t = 0
if (n>=3 & m<=50):
    #print("good")
    while i != (n+1): # SYDA i
        if (i%2 > 0):
            while x != m: #SYDA X
                print("#", end="")
                x += 1
        else:
            while t != (m-1): #SYDA T
                print(".", end='')
                t +=1
            print("#", end="")
        print("")
        i += 1
        x = 0
        t = 0
else:
    print("Ti dyrackiy? n>=3 & m<=50")
# n - stroka
# m - stolbci
