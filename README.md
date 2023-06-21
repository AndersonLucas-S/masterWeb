# masterWeb
Pagina de checkout vue.JS + Laravel

Abra o terminal e navegue até a pasta raiz do projeto Vue.js.

Execute o seguinte comando para instalar as dependências do projeto:
npm install


Após a conclusão da instalação das dependências, execute o seguinte comando para iniciar o servidor de desenvolvimento:
npm run serve

Abra o terminal e navegue até a pasta raiz do projeto Laravel.

Execute o seguinte comando para instalar as dependências do projeto usando o Composer:

composer install

Após a conclusão da instalação das dependências, crie um arquivo .env na raiz do projeto e configure as variáveis de ambiente necessárias, como informações de banco de dados.

Execute o seguinte comando para gerar uma chave para a aplicação:
php artisan key:generate


Execute o comando para criar as tabelas no banco de dados:
php artisan migrate --seed

Execute o comando para iniciar o servidor de desenvolvimento:
php artisan serve

OBSERVAÇÃO: Cada repositório tem seu Dockerfile, então fique a vontade caso queira usar o docker para subir a aplicação.
