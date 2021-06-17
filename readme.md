# Sistema de Gerenciamento de Vendas

## <a name="about"></a>Sobre

<p>Este sistema tem por finalidade receber requisicões HTTP de usuários de diferentes sistemas e, 
a partir delas, agendar ou enviar e-mails através da biblioteca Mailchimp.</p>

<p>Além disso, o sistema gera logs dos emails enviados e gera eventos MySQL que gerarão um segundo
log no momento que o email foi programado para ser enviado.</p>

## Instalação

<p>Para utilizar o sistema acima, siga as instruções a seguir:</p>

### 1. Baixar o código
<p>Execute o comando abaixo para baixar o código:</p>

```shell
git clone https://github.com/Henrique523/sistema-vendas.git
```

<p>Em seguida, acessar a pasta em que o sistema foi baixado e executar os comandos abaixo:</p>

```shell
composer install
```

### 2. Configurar o banco de dados

<p>O banco de dados utilizado é o <b>MySQL</b>. Portanto, sera necessário tê-lo instalado na mesma
máquina em que o código foi instalado.</p>

<p>Em seguida, entrar no terminal do mysql e executar os seguintes comandos:</p>

```mysql
CREATE DATABASE vendas;
SET GLOBAL event_scheduler = ON;
CREATE USER 'sistema_vendas'@'localhost' IDENTIFIED BY 'SistemaVendas';
GRANT ALL PRIVILEGES ON vendas . * TO 'sistema_vendas'@'localhost';
FLUSH PRIVILEGES;
```

Após esta etapa, voltar para a pasta do projeto

### 3. Configurar arquivos do projeto

Criar uma cópia do arquivo `.env.example` e nomeá-la como `.env`.
Em seguida, alterar os valores nas variáveis conforme mostrado abaixo:

```dotenv
APP_ENV=prod
APP_DEBUG=false

MAILCHIMP_KEY=
APP_KEY=

DB_DATABASE=vendas
DB_USERNAME=sistema_vendas
DB_PASSWORD=SistemaVendas
```
> **_Observação_:** O valor da variaável `MAILCHIMP_KEY` será enviado por e-mail e whatsapp e deverá
> ser colocado no arquivo obrigatoriamente também. O Mesmo vale para a chave `APP_KEY`

### 4. Criar as tabelas

Nesta etapa serão geradas as tabelas, além de popular a tabela **Users**. Seguir os comandos
abaixo no terminal:

```shell
php artisan migrate
php artisan db:seed --class=UsersTableSeeder
```

<p>Efetuados todos os passos, o sistema já esta configurado e pronto para ser executado
através do comando abaixo.</p>

```shell
php artisan serve
```
---

## Funcionamento

O sistema, como dito no título [**Sobre**](#about), receberá requisições HTTP através de vários
sistemas diferentes. Para que as requisições sejam enviadas da forma correta,
sera necessário enviá-las através do método <span style="color: orange">POST</span> na rota `/agendar`.

<p>Um exemplo do body que deve vir na requisicão segue abaixo:</p>

```json
{
    "nome": "Fulano da Silva", 
    "email": "fulano@teste.com.br", 
    "assunto": "Teste", 
    "corpo_email": "Olá mundo!", 
    "agendar": "2021-05-15 08:00:00"
}
```

### Importante

> **Aviso 1**: O sistema considera que apenas usuários cadastrados no banco de dados, e
> com seus respectivos emails podem enviar email. Caso contrário, o sistema irá
> lançar uma exceção.

>  **Aviso 2**: O sistema lançará também uma exceção caso o usuário tente agendar
> um e-mail com uma data do passado. O campo *agendar* do corpo da requisicão, porém,
> pode ser enviado vazio caso o email tenha que ser enviado automaticamente.

Para simular os testes, foi criado um seeder que popula o banco de dados 
com três usuários. Para saber dados destes usuários para serem utilizados nos testes,
basta executar uma requisicão <span style="color: green">GET</span> para a rota
`/usuarios`.
