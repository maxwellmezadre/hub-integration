### Como configurar e rodar o projeto

1. Clone o repositório
```bash
git clone https://github.com/maxwellmezadre/hub-integration
```

2. Instale as dependências
```bash
composer install
```

3. Copie o arquivo .env.example para .env
```bash
cp .env.example .env
```

4. Gere a chave da aplicação
```bash
php artisan key:generate
```

5. Configure a chave da API Real Vesti no arquivo .env e da empresa
```bash
SALES_PLATFORM_API_KEY=chave_da_api
SALES_PLATFORM_COMPANY_ID=chave_da_empresa
```

6. Abra o navegador e rode a integração
```bash
http://localhost:8000/integracao
```
