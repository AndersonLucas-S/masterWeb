# Imagem base
FROM node:16.17.0-alpine

# Diretório de trabalho
WORKDIR /app

# Copiar arquivos do projeto
COPY . .

# Instalar dependências
RUN npm install

# Compilar o projeto para produção
RUN npm run build

# Expor a porta do servidor Vue.js
EXPOSE 8080

# Comando para iniciar o servidor Vue.js
CMD ["npm", "run", "serve"]
