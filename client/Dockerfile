FROM node:18 as build

WORKDIR /var/www/

COPY package.json .

RUN npm install

COPY . .


CMD ["npm", "start"]