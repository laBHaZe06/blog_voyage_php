FROM node:18 AS build

WORKDIR /var/www/

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

FROM node:18

WORKDIR /var/www/

COPY --from=build /var/www/build ./build
COPY --from=build /var/www/node_modules ./node_modules
COPY --from=build /var/www/package*.json ./

CMD ["npm", "run", "start"]