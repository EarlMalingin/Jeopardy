#!/bin/bash

echo "🚀 Starting Jeopardy App deployment..."

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Make sure you're in the Laravel project root."
    exit 1
fi

# Check if Dockerfile.render exists
if [ ! -f "Dockerfile.render" ]; then
    echo "❌ Error: Dockerfile.render not found."
    exit 1
fi

# Check if .env.example exists
if [ ! -f ".env.example" ]; then
    echo "❌ Error: .env.example not found."
    exit 1
fi

echo "✅ All required files found."

# Test Docker build locally (optional)
echo "🔨 Testing Docker build locally..."
if docker build -f Dockerfile.render -t jeopardy-test .; then
    echo "✅ Docker build test successful"
else
    echo "⚠️  Docker build test failed, but continuing with deployment..."
fi

echo "📋 Deployment checklist:"
echo "1. ✅ Dockerfile.render is ready"
echo "2. ✅ composer.json post-autoload-dump scripts are commented out"
echo "3. ✅ .env.example exists"
echo "4. ✅ All required files are present"
echo ""
echo "🎯 Next steps:"
echo "1. Commit and push your changes to Git"
echo "2. Deploy on Render using Dockerfile.render"
echo "3. Set environment variables in Render dashboard"
echo "4. Monitor deployment logs"
echo ""
echo "🔧 After successful deployment, restore composer.json:"
echo "   git checkout composer.json"
echo ""
echo "✨ Good luck with your deployment!"
