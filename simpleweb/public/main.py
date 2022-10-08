#!/usr/bin/python3

from flask import Flask, request, render_template
import urllib.request
import requests
from socket import inet_aton, gethostbyname
from struct import unpack

app = Flask(__name__)
FLAG = "POX{996b625b8f6630cabed208b7def1e89c8edf264cf100322b3dcdacdcb95cda38}"

def ip2long(ip_addr):
    return unpack("!L", inet_aton(ip_addr))[0]

def valid_check(scheme, host):
    try:

        real_host = ip2long(gethostbyname(host))

        if scheme not in ["http", "https"]:
            return True

        if '\\' in host:
            return True

        return ip2long('127.0.0.0') >> 24 == real_host >> 24 or \
            ip2long('10.0.0.0') >> 24 == real_host >> 24 or \
            ip2long('172.16.0.0') >> 20 == real_host >> 20 or \
            ip2long('192.168.0.0') >> 16 == real_host >> 16 or \
            ip2long('0.0.0.0') >> 24 == real_host >> 24

    except:
        return True

@app.route("/", methods=["GET", "POST"])
def index():
    if request.method == "GET":
        return render_template("index.html")
    if request.method == "POST":
        try:
            url = request.form['url']
            scheme = urllib.request.urlparse(url).scheme
            host = urllib.request.urlparse(url).hostname

            if valid_check(scheme, host):
                return 'Invaild URL..'
            else:
                return requests.get(f"{url}").text
        
        except Exception as e:
            return f'Oops! Error Occured.. {e}'

@app.route("/flagme", methods=["GET"])
def flagme():
    if request.remote_addr != "127.0.0.1":
        print(request.remote_addr)
        return "Nice TRY!"
    return FLAG

if __name__ == "__main__":
    app.run('0.0.0.0', 80)