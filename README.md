# 📷 GooDFocus97

Painel administrativo desenvolvido para o gerenciamento e publicação de fotografias no site **GooDFocus97**.

O projeto tem como objetivo fornecer uma interface para administrar as fotos que serão disponibilizadas no site, permitindo organizar informações como título, descrição, câmera e categorias.

---

## 🖥️ Telas desenvolvidas

Para acessar as telas desenvolvidas até o momento, veja o arquivo [**TELAS DESENVOLVIDAS**](https://github.com/GDF97/goodfocus97-fullstack/blob/main/design.md).

---

## 🚀 Tecnologias

O projeto foi desenvolvido utilizando:

- **PHP**
- **Laravel**
- **MySQL**
- **Tailwind CSS**
- **Blade**
- **JavaScript**
- **HTML5**

---

## 🎯 Objetivo

O **GooDFocus97** funciona como o painel de administração do site, centralizando o gerenciamento das fotografias.

Entre as principais funcionalidades estão:

- 📸 Publicação de fotografias
- ✏️ Edição de fotografias
- 🗑️ Exclusão de fotografias
- 🏷️ Organização por categorias
- 📷 Associação de fotografias com câmeras
- 📝 Definição de título e descrição
- 🖼️ Upload e gerenciamento de imagens
- 👤 Associação das publicações ao usuário responsável
- 🔐 Área administrativa protegida por autenticação

---

## 📂 Estrutura do projeto

A aplicação segue a estrutura padrão de um projeto Laravel, utilizando seus principais recursos para separar responsabilidades.

```text
GooDFocus97/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   ├── Models/
│   └── Providers/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── build/
│   │   └── assets/
│   └── storage → storage/app/public
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/
│       ├── components/
│       │   ├── admin/
│       │   │   └── sidebar/
│       │   └── layout/
│       └── public/
│
├── routes/
│
├── storage/
│   └── app/
│       ├── private/
│       └── public/
│           └── pictures/
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## ⚙️ Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/GooDFocus97.git
```

Entre na pasta do projeto:

```bash
cd GooDFocus97
```

### 2. Instale as dependências do Laravel

```bash
composer install
```

### 3. Instale as dependências do frontend

```bash
npm install
```

### 4. Configure o ambiente

Crie o arquivo `.env`:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

### 5. Configure o banco de dados

No arquivo `.env`, configure as informações do MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=goodfocus97
DB_USERNAME=root
DB_PASSWORD=
```

Depois execute as migrations:

```bash
php artisan migrate
```

Caso o projeto possua seeders:

```bash
php artisan db:seed
```

### 6. Configure o armazenamento das imagens

Crie o link simbólico para o armazenamento público:

```bash
php artisan storage:link
```

### 7. Execute o projeto

Inicie o servidor Laravel:

```bash
php artisan serve
```

Em outro terminal, execute o Vite:

```bash
npm run dev
```

O projeto estará disponível em:

```text
http://localhost:8000
```

---

## 🖼️ Gerenciamento de fotografias

O painel permite cadastrar fotografias informando dados relacionados à publicação.

Exemplo de informações associadas a uma fotografia:

```text
Fotografia
├── Imagem
├── Título
├── Descrição
├── Câmera
├── Categorias
└── Usuário responsável
```

As categorias permitem que uma mesma fotografia seja relacionada a diferentes classificações.

---

## 🗃️ Banco de dados

O sistema utiliza **MySQL** para armazenar os dados da aplicação.

Entre as principais entidades estão:

- `users`
- `pictures`
- `categories`
- `cameras`
- `picture_category`

A tabela `picture_category` é utilizada para representar o relacionamento entre fotografias e categorias.

```text
Picture
   │
   ├── belongsTo → User
   ├── belongsTo → Camera
   │
   └── belongsToMany → Category
                         │
                         └── picture_category
```

---

## 🎨 Interface

A interface administrativa foi construída utilizando **Tailwind CSS**, buscando uma experiência simples e responsiva para gerenciamento do conteúdo.

O painel possui componentes para:

- Navegação administrativa
- Listagem de fotografias
- Formulários
- Upload de imagens
- Seleção de categorias
- Pré-visualização de fotografias
- Gerenciamento de conteúdo

---

## 🔐 Autenticação

O acesso ao painel administrativo é destinado a usuários autenticados.

As rotas administrativas são protegidas para impedir que usuários não autenticados tenham acesso às funcionalidades de gerenciamento.

---

## 📌 Status

🚧 **Em desenvolvimento**

O projeto ainda está sendo desenvolvido e novas funcionalidades serão adicionadas conforme o desenvolvimento do site **GooDFocus97** avança.

#### ✅ TODO

- Admin
    - [ ] Error handling
    - [ ] Toast notification
    - [ ] Modal for delete
- Public:
    - [ ] Landing Page
    - [ ] One Picture
    - [ ] Gallery

---

## 📄 Licença

Este projeto é desenvolvido para fins de estudo e desenvolvimento do site **GooDFocus97**.
