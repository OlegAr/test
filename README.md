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

<br>

### Installation:
1. git clone https://github.com/OlegAr/test.git
2. cd test
3. docker-compose up --build

