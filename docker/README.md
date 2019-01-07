# airserbia@anvil

New JU web

## Setup Local Project

- make dir e.g. airserbia_new
- clone https://github.com/massvisionnet/anvil.git to airserbia_new/anvil directory; switch to airserbia branch
- clone https://github.com/massvisionnet/airserbia.git to airserbia_new/airserbia
- in shell go to airserbia_new/airserbia and run __composer install__ 
- start docker: in airserbia_new/airserbia run __docker-compose up__
- mysql database is at: __mysql -h127.0.0.1 -P3308 -uairserbia -pdocker__
- connecting to docker: docker exec -it airserbia-web /bin/bash
- site is at  
  http://localhost:81
- run setup several times:
  http://localhost:81/setup.php
- burning docker images: <br>
      docker stop $(docker ps -a -q)  <br>
      docker rm $(docker ps -a -q) <br>
      docker rmi $(docker images -q) <br>
- view error log:
  docker logs -f airserbia-web >/dev/null
