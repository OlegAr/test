# Use the official PHP image as the base image
FROM php:7.4-cli

# Set the working directory to /app
WORKDIR /app

# Copy the PHP files to the working directory
COPY . /app

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Expose port 8000 for the PHP server
EXPOSE 8000

# Start the PHP server when the container launches
CMD ["php", "-S", "0.0.0.0:8000"]
