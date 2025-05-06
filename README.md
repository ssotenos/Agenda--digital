# Documentação de Desenvolvimento - Agenda Digital

## Sistema de Agenda Digital

**Autor**: [Sérgio,Milena,Melissa,Priscila]  
**Versão**: PHP 8.1+ | MySQL 5.7+
**Data**: Início: 22/04/25 | Término: 06/05/25

1.  Visão Geral
    Este documento descreve o funcionamento da Agenda Digital, um sistema que permite aos usuários gerenciar eventos pessoais. O sistema é composto pelos seguintes módulos:

- Tela de Login (`index.php`): Autenticação de usuários e redirecionamento para a agenda.
- Cadastro de Usuários (`cadastro.php`): Permite que novos usuários criem uma conta.
- Painel de Eventos (`painel.php`): Interface principal para visualizar e adicionar eventos.

2.  Estrutura do Banco de Dados
    2.1. Tabelas Principais
    O banco de dados utiliza as seguintes tabelas:

Tabela `usuario`
Armazena as credenciais dos usuários.

```sql
CREATE TABLE `usuario` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(60) NOT NULL,
  `senha` VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
```

Tabela `eventos`
Armazena os eventos cadastrados pelos usuários.

```sql
CREATE TABLE `eventos` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `titulo` VARCHAR(80) NOT NULL,
  `data_evento` DATE NOT NULL,
  `usuario_id` INT NOT NULL,
  FOREIGN KEY (`usuario_id`) REFERENCES `usuario`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
```

---

3.  Backend (PHP)
    3.1. Arquivos Críticos

- `conexao.php`: Configura a conexão com o banco de dados MySQL.
- `protect.php`: Verifica se o usuário iniciou uma sessão antes de acessar páginas restritas.
- `logout.php`: Encerra a sessão do usuário e redireciona para a tela de login.

  3.2. Funcionalidades Implementadas

- Autenticação de Usuários:
  - Valida credenciais no login (`index.php`).
  - Armazena o ID e nome do usuário na sessão.
- Cadastro de Usuários:
  - Verifica se o nome de usuário já existe.
  - Valida se as senhas coincidem (`cadastro.php`).
- Gestão de Eventos:

  - CRUD (Create, Read, Update) de eventos vinculados ao usuário logado ('index.php').

  4.  Frontend (HTML/CSS)
      4.1. Componentes Principais

- Tela de Login (`index.php`)
  - Formulário com campos para nome e senha.
  - Link para cadastro de novos usuários.
- Tela de Cadastro (`cadastro.php`)
  - Validação de senha no lado do cliente.
  - Design com CSS.
- Painel de Eventos (`painel.php`)

  - Tabela dinâmica para listar eventos.
  - Formulário para adicionar eventos.

  4.2. Estilos (CSS)

- `style.css`: Estilização da tela de login.  
  -`cadastro.css`: Estilos específicos para a página de cadastro.
- `painel.css`: Design do painel de eventos, incluindo tabelas e botões.

5.  Instalação
    5.1. Requisitos

- Servidor web (Apache).
- PHP 7.4 ou superior.
- MySQL 5.7 ou superior.

  5.2. Passos de Instalação

1. Importar o esquema do banco de dados:  
   modelagemAgenda.mwb
   ```

   ```
2. Configurar a conexão:  
   Editar o arquivo `conexao.php` com as credenciais do banco de dados.

```

 Fluxo de Funcionamento
1. Login:
   - O usuário acessa `index.php`, insere suas credenciais e é redirecionado para `painel.php`.
2. Cadastro:
   - Novo usuário preenche o formulário em `cadastro.php` e é redirecionado para o login após o cadastro.
3. Gestão de Eventos:
   - No painel, o usuário pode adicionar eventos, que são exibidos em uma tabela dinâmica.

```
