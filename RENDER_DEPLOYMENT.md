# Render Deployment Guide for Jeopardy App

## Overview
This guide will help you deploy your Laravel Jeopardy application to Render using Docker.

## Prerequisites
- A Render account
- Your Laravel application code pushed to a Git repository (GitHub, GitLab, etc.)

## Deployment Steps

### 1. Create a New Web Service on Render

1. Log in to your Render dashboard
2. Click "New +" and select "Web Service"
3. Connect your Git repository
4. Choose the repository containing your Jeopardy app

### 2. Configure the Web Service

**Basic Settings:**
- **Name**: `jeopardy-app` (or your preferred name)
- **Environment**: `Docker`
- **Region**: Choose the closest to your users
- **Branch**: `main` (or your default branch)
- **Dockerfile Path**: `Dockerfile.render`

**Build Settings:**
- **Build Command**: Leave empty (Dockerfile handles this)
- **Start Command**: `/var/www/html/start.sh`

### 3. Environment Variables

Add these environment variables in Render:

```
APP_NAME="Jeopardy Game"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
APP_KEY=base64:your-generated-key-here

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_LIFETIME=120

BROADCAST_DRIVER=log
FILESYSTEM_DISK=local
```

### 4. Generate Application Key

You can generate an application key using:
```bash
php artisan key:generate --show
```

Or let Render generate it automatically (the Dockerfile will handle this).

### 5. Advanced Settings

**Health Check Path**: `/health`

### 6. Deploy

Click "Create Web Service" and wait for the deployment to complete.

## Troubleshooting

### Common Issues and Solutions

#### 1. "Could not open input file: artisan" Error
**Solution**: The Dockerfile has been updated to:
- Copy files in the correct order
- Set proper permissions on the artisan file
- Use a startup script that handles initialization properly

#### 2. Database Connection Issues
**Solution**: The app uses SQLite which is file-based and doesn't require external database setup.

#### 3. Permission Issues
**Solution**: The Dockerfile now:
- Sets proper ownership to www-data
- Creates necessary directories with correct permissions
- Handles storage directory permissions

#### 4. Cache Issues
**Solution**: The startup script clears and rebuilds all caches on startup.

### Debugging Deployment

1. **Check Build Logs**: Look for any errors during the Docker build process
2. **Check Runtime Logs**: Monitor the application logs for runtime errors
3. **Test Health Endpoint**: Visit `/health` to verify the app is running
4. **Check Environment Variables**: Ensure all required environment variables are set

### Manual Deployment Steps

If automatic deployment fails, you can:

1. **Build Locally**:
   ```bash
   docker build -f Dockerfile.render -t jeopardy-app .
   ```

2. **Test Locally**:
   ```bash
   docker run -p 8000:8000 jeopardy-app
   ```

3. **Push to Registry**: If needed, push to a container registry and deploy from there.

## Post-Deployment

### 1. Verify Deployment
- Visit your app URL
- Check the health endpoint: `https://your-app.onrender.com/health`
- Test the main game functionality

### 2. Monitor Performance
- Use Render's built-in monitoring
- Check logs for any errors
- Monitor resource usage

### 3. Set Up Custom Domain (Optional)
- In Render dashboard, go to your service settings
- Add your custom domain
- Update DNS records as instructed

## File Structure

The deployment uses these key files:
- `Dockerfile.render` - Main Docker configuration
- `docker/nginx.conf` - Nginx web server configuration
- `docker/supervisord.conf` - Process manager configuration
- `render.yaml` - Render-specific configuration (optional)
- `.dockerignore` - Files to exclude from Docker build

## Support

If you encounter issues:
1. Check the Render documentation
2. Review the build and runtime logs
3. Test the health endpoint
4. Verify all environment variables are set correctly

## Recent Fixes Applied

### Fixed Issues:
1. **Artisan File Not Found**: Updated Dockerfile to copy files in correct order and set proper permissions
2. **Missing .env.example**: Created the file for Docker build process
3. **Permission Issues**: Added proper file and directory permissions
4. **Startup Script**: Created robust startup script that handles initialization
5. **Health Check**: Added `/health` endpoint for deployment monitoring
6. **Error Handling**: Added fallback error handling in startup script

### Key Changes:
- Moved all Laravel artisan commands to startup script
- Added proper error handling and logging
- Fixed file permissions and ownership
- Created comprehensive startup script
- Added health check endpoint
- Improved Docker build process

Your app should now deploy successfully on Render!
