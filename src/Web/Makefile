SQL_SCRIPT := ../BdD/script.sql
TEXT-RED :=\033[0;31m
TEXT-GREEN :=\033[0;32m
TEXT-YELLOW :=\033[0;33m
TEXT-BLUE :=\033[0;34m

BG-RED :=\033[1;97;41m
BG-GREEN :=\033[1;97;42m
BG-YELLOW :=\033[1;97;103m
BG-BLUE :=\033[1;97;44m

NC :=\033[0m

TAB := $(shell echo "  ")

METHOD := GET

all: install

install:
	@echo "Installing dependencies..."
	@npm install
	@echo "Installing php dependencies..."
	@composer install
	@echo "Creating .env file..."
	@cp .env.example .env
	@echo "${TAB}${TEXT-YELLOW}Generating application key...${NC}"
	@php artisan key:generate

build:
	@echo "${TAB}${TEXT-YELLOW}Building project...${NC}"
	@npm run build
	@echo "${TAB}${GREEN}Project built successfully${NC}"
	@echo "${TAB}${BG-YELLOW}WARNING${NC}"
	@echo "You need to configure your .env file and run 'make migration'"

script:
	@echo "Generating SQL Script..."
	@php artisan tinker --no-ansi --execute 'echo implode(PHP_EOL, array_reduce(glob("database/migrations/*.php"), fn($$c, $$i) => [...$$c, ...array_column(app("db")->pretend(fn() => (include $$i)->up()), "query")], []))' > $(SQL_SCRIPT)
	@sed -i "s/[^\d0-\d127é]//g" $(SQL_SCRIPT)
	@sed -i "s/^\s*//g" $(SQL_SCRIPT)
	@sed -i "s/\s*$$//g" $(SQL_SCRIPT)
	@sed -i "s/$$/;/g" $(SQL_SCRIPT)
	@echo "${TAB}${TEXT-GREEN}SQL Script generated in $(SQL_SCRIPT)${NC}"

migration: clean script
	@echo "\nRunning migrations..."
	@php artisan migrate --seed

start:
	@echo "${TAB}${BG-YELLOW} Running server ${NC}"
	@echo "${TAB}⚠️${TAB} Don't forget to run the smtp server with ${TEXT-BLUE}'make smtp'${NC}"
	@php artisan serve

smtp: 
	@echo "${TAB}${BG-YELLOW} Running smtp server ${NC}"
	@echo "${TAB}${BG-RED} smtp is running ${NC}"
	@java -jar fakeSMTP.jar -s -p 2525

scheduler:
	@echo "${TAB}${TEXT-YELLOW} Running commands once ${NC}"
	@php artisan app:verify-status
	@echo "${TAB}${TEXT-GREEN} Commands executed ${NC}"
	@echo
	@echo "${TAB}${BG-RED} Scheduler is running ${NC}"
	@php artisan schedule:work

route:
	@echo "${TAB}${TEXT-GREEN} Available $(METHOD) routes ${NC}"
	@php artisan route:list --method=$(METHOD) --except-vendor

start-queue:
	@echo "${TAB}${BG-YELLOW} Running queue ${NC}"
	@php artisan queue:work

restart-queue:
	@echo "${TAB}${BG-YELLOW} Restarting queue ${NC}"
	@php artisan queue:restart

help:
	@echo "Available commands:"
	@echo "${TAB}${TEXT-YELLOW}make install${NC}\n\t- Install dependencies"
	@echo "${TAB}${TEXT-YELLOW}make build${NC}\n\t- Build project"
	@echo "${TAB}${TEXT-YELLOW}make script${NC}\n\t- Generate SQL script"
	@echo "${TAB}${TEXT-YELLOW}make migration${NC}\n\t- Run migrations"
	@echo "${TAB}${TEXT-YELLOW}make start${NC}\n\t- Run server"
	@echo "${TAB}${TEXT-YELLOW}make smtp${NC}\n\t- Run smtp server"
	@echo "${TAB}${TEXT-YELLOW}make scheduler${NC}\n\t- Run scheduler"
	@echo "${TAB}${TEXT-YELLOW}make clean${NC}\n\t- Clean database"
	@echo "${TAB}${TEXT-YELLOW}make route${NC}\n\t- Display all route available in the project"
	@echo "${TAB}${TEXT-YELLOW}make help-route${NC}\n\t- Detailed help for 'make route'"
	@echo "${TAB}${TEXT-YELLOW}make start-queue${NC}\n\t- Run queue"
	@echo "${TAB}${TEXT-YELLOW}make restart-queue${NC}\n\t- Restart queue"
	@echo "${TAB}${TEXT-YELLOW}make help${NC}\n\t- Show this help"

help-route:
	@echo "${TEXT-BLUE}Command${NC}: make route"
	@echo "${TEXT-BLUE}Description${NC}: Display all routes available in the project."
	@echo "${TEXT-BLUE}Usage${NC}: make route [METHOD=xxx]"
	@echo "${TEXT-BLUE}Options${NC}:"
	@echo "${TAB}METHOD=xxx${TAB}Filter routes by HTTP method ${BG-YELLOW}(GET, POST, PUT, PATCH, DELETE)${NC}"

clean:
	@echo "${TAB}${BG-RED} Cleaning database ${NC}"
	@php artisan db:wipe