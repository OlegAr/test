## README:
<br>
<br>

#### The project stores users data(Name, Emails).
#### The data can be added, removed and seen on site - http://app.loc
#### Also, data can be changed by making POST request directly to PHP API
#### example:
```
curl -X POST -d "action=add&data[name]=ivan&data[email]=ivan@mail.com" http://api.app.loc/index.php 
```
<br>

### Pre Requirements:
1. Install Git
2. Install docker, docker-compose
3. Add this 2 lines to /etc/hosts on your machine:
```
127.0.0.1    app.loc
127.0.0.1    api.app.loc
```

<br>

### Installation:
```
git clone https://github.com/OlegAr/test.git
```
```
cd test
```
```
docker-compose up --build
```

