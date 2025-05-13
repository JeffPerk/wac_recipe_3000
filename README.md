# Recipe Search 3000

Recipe Search 3000 is a full-stack web application built for a coding challenge, featuring a robust recipe search engine. It allows users to search for recipes by author email, keyword, or ingredient, view paginated results, and explore detailed recipe pages by slug. The application combines a Laravel API backend with a Nuxt 3 frontend, delivering a polished, responsive, and accessible user experience.

## Features

- **Recipe Search**: Search recipes by author email, keyword (name, description, steps), or ingredient with AND logic for combined filters.
- **Paginated Results**: Display search results with pagination (10 recipes per page) for efficient browsing.
- **Recipe Details**: View detailed recipe pages by slug, including name, author, description, ingredients, and steps.
- **Responsive UI**: Clean, modern interface with Tailwind CSS, featuring a gradient header, white content cards, and responsive layouts for mobile and desktop.
- **Animations**: Subtle fade-in transitions for search results and recipe details enhance user experience.
- **Accessibility**: ARIA attributes and keyboard navigation ensure inclusivity.
- **Robust Testing**: Comprehensive test suites for backend (PHPUnit) and frontend (Vitest), covering API endpoints, component rendering, and user interactions.

## Tech Stack

- **Backend**: Laravel 10 (API with Eloquent ORM, Sail for Dockerized development)
- **Frontend**: Nuxt 3 (Vue 3, server-side rendering, Tailwind CSS)
- **Database**: MySQL (development), SQLite in-memory (testing)
- **Testing**:
  - PHPUnit for API endpoint and repository tests
- **Styling**: Tailwind CSS for responsive, utility-first design
- **Environment**: Laravel Sail (Docker) for backend, Node.js for frontend

## Setup Instructions

### Prerequisites
- **Docker**: Required for Laravel Sail (backend).
- **Node.js**: Version 18+ for Nuxt frontend.
- **Composer**: For Laravel dependencies.
- **npm**: For frontend dependencies.

### Backend Setup (Laravel)
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/JeffPerk/wac_recipe_3000.git recipe-search-3000
   cd recipe-search-3000

2. **Kickstart Sail**
```bash
docker run --rm \
    --pull=always \
    -v "$(pwd)":/opt \
    -w /opt \
    laravelsail/php82-composer:latest \
    bash -c "composer install"
```

3. **Run the application**
`cp .env.example .env`

`./vendor/bin/sail up -d`

`./vendor/bin/sail artisan key:generate`

4. **Build the Database**
`./vendor/bin/sail artisan migrate`

`./vendor/bin/sail artisan db:seed`

5. **Kickstart the nuxt frontend**
`./vendor/bin/sail npm install --prefix frontend`

6. **Run the frontend**
`./vendor/bin/sail npm run dev --prefix frontend`

7. **Confirm your application**
visit the frontend http://localhost:3000

visit the backend http://localhost:8888


### Connecting to your database from localhost
`docker exec -it laravel-mysql-1 bash -c "mysql -uroot -ppassword"`

Or use any database GUI and connect to 127.0.0.1 port 3333


### Other tips
`./vendor/bin/sail down` to bring down the stack

Sometimes it's necessary to restart the nuxt app when adding new routes. Simply `ctrl+c` on the npm command execute
`./vendor/bin/sail npm run dev --prefix frontend` again
