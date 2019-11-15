# Requisitos:
#   PHP: Version 7.3.0
#   PostgreSQL: pdo_pgsql 	9.6.9
# Informações:
#   execute o arquivo "info.PHP"

# Versão 2.0
# Alterado em 15/11/2019


# Alterações Necessárioas para implantação:
# 1) Altere as configurações de acesso do BD no arquivo "connection.php".
# 2) Altere a variável "$_config['url']" presente na linha 4 do arquivo "service-config.php".
# 3) O script para criar e povoar o banco de dados se encontra na em "bd/SQL-crm.sql".
# 4) Caso seja necessário alterar as consultas SQL usadas, elas se encontram nos arquivos:
    "crud.ph": linha 24 e linhas 37.
    "listar.php": linha 4.
# 5) O projeto está organizado utilizando caminho relativo.
    A disposição e nome das pastas deve ser mantido para evitar conflitos.
