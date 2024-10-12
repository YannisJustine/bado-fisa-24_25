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
	@echo "${TAB}${TEXT-YELLOW}Generating application key...${NC}"
	@php artisan key:generate

build:
	@if [ ! -f .env ]; then \
		cp .env.example .env; \
		echo "${TAB}${TEXT-YELLOW}.env file not found. Created from .env.example.${NC}"; \
	else \
		echo "${TAB}${TEXT-GREEN}.env file exists.${NC}"; \
	fi
	@echo "${TAB}${TEXT-YELLOW}Building project...${NC}"
	@npm run build
	@echo "${TAB}${GREEN}Project built successfully${NC}"

migration:  
	@echo "\nRunning migrations..."
	@php artisan migrate 

seed: 
	@echo "\nRunning seeders..."
	@php artisan db:seed

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

clean:
	@echo "${TAB}${BG-RED} Cleaning database ${NC}"
	@php artisan db:wipe