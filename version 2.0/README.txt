# Requisitos:
#   PHP: Version 7.3.0
#   PostgreSQL: pdo_pgsql 	9.6.9
# Informa��es:
#   execute o arquivo "info.PHP"

# Vers�o 2.0
# Alterado em 15/11/2019


# Altera��es Necess�rioas para implanta��o:
# 1) Altere as configura��es de acesso do BD no arquivo "connection.php".
# 2) Altere a vari�vel "$_config['url']" presente na linha 4 do arquivo "service-config.php".
# 3) O script para criar e povoar o banco de dados se encontra na em "bd/SQL-crm.sql".
# 4) Caso seja necess�rio alterar as consultas SQL usadas, elas se encontram nos arquivos:
    "crud.ph": linha 24 e linhas 37.
    "listar.php": linha 4.
# 5) O projeto est� organizado utilizando caminho relativo.
    A disposi��o e nome das pastas deve ser mantido para evitar conflitos.
