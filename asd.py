import urllib.request
import bs4 as bs

source = urllib.request.urlopen("http://makelovepizza.ru/").read()

soup = bs.BeautifulSoup(source, 'lxml')

products = soup.find_all('div', {'class': "product-item-main product-clickable"})

#print ((some_stuff))
#producs = ['products', 2,3,4]

pizza = {}

for product in products:
    name = product.find_all('div', {'class': 'link-detail'})[0]
    name = name.find_all('span', {'itemprop': 'name'})[0].get_text()

    medium_pizza = product.find_all('div',{'class': 'value-price'})[1]
    price = medium_pizza.get_text().strip().replace('P', "")

    energy = product.find_all('div', {'class': 'item-energy'})[1].get_text().split()[0]



    #print(energy)
    #print(price)
    pizza[name] = [int(energy),int(price)]

#print(pizza)
maximum = 0
winner = ''
for name, attributes in pizza.items():
    val = attributes[0] / attributes[1]

    if(val > maximum):
        maximum = val
        winner = name


print(winner, maximum)
    #print(name, attributes)
