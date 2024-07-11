#!/bin/bash

container_id=$(docker ps --filter "name=outlineadmin" --format "{{.ID}}")

if [ -z "$container_id" ]; then
    echo "Container not found. Please ensure that the container is running."
    exit 1
fi

create_admin_user() {
    docker exec -it "$container_id" bash -c "php artisan admin:make"
}

reset_admin_password() {
    docker exec -it "$container_id" bash -c "php artisan admin:password"
}

echo "Select an option:"
echo "1. Create Admin User"
echo "2. Reset Admin Password"
echo "3. Exit"
read -rp ">>> " choice

case $choice in
    1)
        create_admin_user
        ;;
    2)
        reset_admin_password
        ;;
    3)
        echo "🤚 Exiting..."
        exit 0
        ;;
    *)
        echo "😑 Invalid choice. Exiting..."
        exit 1
        ;;
esac
