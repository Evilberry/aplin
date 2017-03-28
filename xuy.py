from PIL import Image
from random import randint

def random_pixel():
    return(randint(0,256),randint(0,256),randint(0,256))

def mix_pixels(p1,p2):
    r = (p1[0]+p2[0]) / 2
    g = (p1[1]+p2[1]) / 2
    b = (p1[2]+p2[2]) / 2
    return (r,g,b)

def noiselate(pixel, comp_num=0, delta=0 ):
    noise = randint(-delta, delta)
    new_pixel = list(pixel)
    new_pixel[comp_num] = (pixel[comp_num] + noise) % 256
    return tuple(new_pixel)

img = Image.open('pik4a.jpg')
mx,my = img.size
pixels = img.load()

for x in range(mx):
    for y in range(my):
        pixels[x,y] = noiselate(pixels[x,y], 1,  100)

img.show()
