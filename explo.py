import socket
 
HOST = '192.168.0.247'
PORT = 31337
 
sock = socket.socket()
sock.connect((HOST, PORT))
 
sock.send(b"2")
sock.send(b"ch3l0v3k")
sock.send(b"12345")
 
sock.send(b"1")
sock.send(b"ch3l0v3k")
sock.send(b"12345")
ans = sock.recv(100500)
#print ans
 
k = 0
x = 0
while True:
    if x <= 5:
        sock.send(b"2")
        sock.send((str(k)))
        ans = sock.recv(100500)
        print(ans)
        k += 1
        x += 1
    else:
        x = 0        