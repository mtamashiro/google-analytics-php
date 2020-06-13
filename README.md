# google-analytics-php


Exemplo de utilização do Google Analytics API utilizando PHP

# Para que pode ser utilizado 

Quando a informação deve ser compartilhada com diversas pessoas que não possuem acesso ao Google Analtyics.
Quando você quer criar um dashboard com informações diversas do seu sistema e informações do Analytics, assim os gestores não precisarão  instalar ou acessar outro sistema para consultar os dados.

# Como usar

Você precisará ter uma conta criada no Google Developers Console e criar um credencial.
Essa conta precisa ter acesso ao Google Analytics também.

Como criar a Credencial:
<ul>
<li>No Google Developers Console, selecione o menu "Credenciais"</li>
<li>Clique em Criar credenciais e selecione OAuth Client-ID.</li>
<li>Selecione Aplicativo da Web em TIPO DE APLICATIVO.</li>
<li>Defina um nome para a credencial.</li>
<li>Deixe as ORIGENS DE JAVASCRIPT AUTORIZADAS em branco. Elas não são necessárias neste tutorial.</li>
<li>Defina os URIS DE REDIRECIONAMENTO AUTORIZADOS como http://localhost:8080/oauth2callback.php.</li>
<li>Clique em Criar.</li>
<li>faça o download do arquivo JSON, altere o nome dele para "credentials.json" e coloque na pasta do projeto</li>
</ul> 

Após criar a credencial, utilize o composer:<br>
```bash
composer require google/apiclient:^2.0
```


Rode o arquivo example.php

#Métricas e Dimensões
O Google Analytics possui mais de 500 métricas e dimensões, para a ver a lista completa acesse: <a href="https://ga-dev-tools.appspot.com/dimensions-metrics-explorer/" target="_blank">https://ga-dev-tools.appspot.com/dimensions-metrics-explorer</a>





 
