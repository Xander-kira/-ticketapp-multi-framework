# TicketApp - Deployment Guide

Comprehensive deployment instructions for all three framework implementations of the TicketApp project.

## 🚀 Deployment Overview

This guide covers deployment strategies for:

- **React App** - Modern SPA deployment
- **Vue.js App** - Progressive web app deployment
- **Twig/HTML App** - Static site deployment

Each implementation can be deployed independently while maintaining shared localStorage data when hosted on the same domain.

## 📦 Pre-Deployment Checklist

- [ ] All three implementations tested locally
- [ ] Build processes verified for React and Vue
- [ ] Browser compatibility confirmed
- [ ] Environment variables configured (if any)
- [ ] Domain/hosting provider selected

## ⚛️ React App Deployment

### Option 1: Vercel (Recommended)

1. **Prepare for deployment:**

   ```bash
   cd react-app
   npm run build
   ```

2. **Install Vercel CLI:**

   ```bash
   npm install -g vercel
   ```

3. **Deploy to Vercel:**

   ```bash
   vercel
   # Follow prompts to configure project
   ```

4. **Configure vercel.json (optional):**
   ```json
   {
     "rewrites": [{ "source": "/(.*)", "destination": "/index.html" }]
   }
   ```

### Option 2: Netlify

1. **Build the project:**

   ```bash
   cd react-app
   npm run build
   ```

2. **Deploy via Netlify CLI:**

   ```bash
   npm install -g netlify-cli
   netlify deploy --prod --dir=dist
   ```

3. **Or use Netlify drag-and-drop:**
   - Go to [Netlify](https://netlify.com)
   - Drag the `dist` folder to deploy

### Option 3: GitHub Pages

1. **Install gh-pages:**

   ```bash
   cd react-app
   npm install --save-dev gh-pages
   ```

2. **Add to package.json:**

   ```json
   {
     "homepage": "https://username.github.io/ticketapp-react",
     "scripts": {
       "predeploy": "npm run build",
       "deploy": "gh-pages -d dist"
     }
   }
   ```

3. **Deploy:**
   ```bash
   npm run deploy
   ```

### React Build Configuration

**vite.config.js** for production:

```javascript
import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

export default defineConfig({
  plugins: [react()],
  base: "./", // For relative paths
  build: {
    outDir: "dist",
    sourcemap: false, // Disable for production
    minify: "terser",
  },
});
```

## 🟢 Vue.js App Deployment

### Option 1: Vercel (Recommended)

1. **Prepare for deployment:**

   ```bash
   cd vue-app
   npm run build
   ```

2. **Deploy with Vercel:**

   ```bash
   vercel
   # Select Vue.js framework preset
   ```

3. **Configure vercel.json:**
   ```json
   {
     "rewrites": [{ "source": "/(.*)", "destination": "/index.html" }],
     "framework": "vue"
   }
   ```

### Option 2: Netlify

1. **Build and deploy:**

   ```bash
   cd vue-app
   npm run build
   netlify deploy --prod --dir=dist
   ```

2. **Configure \_redirects file:**
   ```
   /*    /index.html   200
   ```

### Option 3: Firebase Hosting

1. **Install Firebase CLI:**

   ```bash
   npm install -g firebase-tools
   firebase login
   ```

2. **Initialize Firebase:**

   ```bash
   cd vue-app
   firebase init hosting
   # Select dist as public directory
   # Configure as SPA
   ```

3. **Deploy:**
   ```bash
   npm run build
   firebase deploy
   ```

### Vue Build Configuration

**vite.config.js** for production:

```javascript
import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
  plugins: [vue()],
  base: "./",
  build: {
    outDir: "dist",
    assetsDir: "assets",
    sourcemap: false,
  },
});
```

## 🏗️ Twig/HTML App Deployment

### Option 1: GitHub Pages (Recommended for Static)

1. **Prepare files:**

   ```bash
   cd twig-app/templates
   # Ensure all *_react_match.html files are ready
   ```

2. **Create GitHub repository**

3. **Push files and enable Pages:**
   - Go to repository Settings > Pages
   - Select source branch
   - Access via `https://username.github.io/repo-name`

### Option 2: Netlify Static

1. **Deploy static files:**

   ```bash
   cd twig-app/templates
   netlify deploy --prod --dir=.
   ```

2. **Or drag-and-drop templates folder to Netlify**

### Option 3: Traditional Web Hosting

1. **For PHP/Twig server rendering:**

   - Upload entire `twig-app` directory
   - Configure Apache/Nginx virtual host
   - Install Composer dependencies:
     ```bash
     composer install
     ```

2. **Example Apache .htaccess:**
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php [QSA,L]
   ```

### Static File Structure for Deployment

```
/
├── home_react_match.html
├── login_react_match.html
├── signup_react_match.html
├── dashboard_react_match.html
├── tickets_react_match.html
└── assets/ (if any)
```

## 🌐 Domain Configuration

### Custom Domain Setup

1. **For Vercel:**

   ```bash
   vercel domains add yourdomain.com
   vercel domains ls
   ```

2. **For Netlify:**

   - Dashboard > Domain settings
   - Add custom domain
   - Configure DNS records

3. **DNS Configuration:**
   ```
   A Record: @ -> [Hosting IP]
   CNAME: www -> [Hosting URL]
   ```

### Multi-Framework Subdomain Strategy

Deploy each framework on subdomains for easy comparison:

- `react.yourdomain.com` - React implementation
- `vue.yourdomain.com` - Vue implementation
- `twig.yourdomain.com` - Twig implementation

## 🔧 Environment Variables

### React (.env.production)

```bash
VITE_APP_TITLE=TicketApp
VITE_API_URL=https://api.yourdomain.com
```

### Vue (.env.production)

```bash
VITE_APP_TITLE=TicketApp
VITE_API_URL=https://api.yourdomain.com
```

### Access in code:

```javascript
const apiUrl = import.meta.env.VITE_API_URL;
```

## 📊 Performance Optimization

### React/Vue Production Optimizations

1. **Bundle Analysis:**

   ```bash
   npm run build
   npx vite-bundle-analyzer dist
   ```

2. **Compression (gzip/brotli):**

   ```javascript
   // vite.config.js
   import { defineConfig } from "vite";
   import { compression } from "vite-plugin-compression";

   export default defineConfig({
     plugins: [compression()],
   });
   ```

3. **CDN Configuration:**
   - Use CDN for Tailwind CSS
   - Optimize image assets
   - Enable caching headers

## 🔍 SEO & Meta Tags

### Update HTML meta tags for production:

```html
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TicketApp - Support Ticket Management</title>
  <meta
    name="description"
    content="Modern support ticket management system with CRUD operations"
  />
  <meta name="keywords" content="tickets, support, CRUD, React, Vue, Twig" />
  <meta property="og:title" content="TicketApp" />
  <meta
    property="og:description"
    content="Multi-framework ticket management system"
  />
  <meta property="og:url" content="https://yourdomain.com" />
  <meta property="og:type" content="website" />
</head>
```

## 🔒 Security Considerations

### Production Security Checklist

- [ ] Remove console.log statements
- [ ] Disable source maps in production
- [ ] Configure HTTPS/SSL certificates
- [ ] Set secure headers (CSP, HSTS)
- [ ] Validate all user inputs
- [ ] Sanitize localStorage data

### Content Security Policy

```html
<meta
  http-equiv="Content-Security-Policy"
  content="default-src 'self' 'unsafe-inline' cdn.tailwindcss.com"
/>
```

## 📈 Monitoring & Analytics

### Add Analytics (Optional)

```html
<!-- Google Analytics -->
<script
  async
  src="https://www.googletagmanager.com/gtag/js?id=GA_TRACKING_ID"
></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag("js", new Date());
  gtag("config", "GA_TRACKING_ID");
</script>
```

## 🚀 Deployment Automation

### GitHub Actions for React/Vue

Create `.github/workflows/deploy.yml`:

```yaml
name: Deploy to Production

on:
  push:
    branches: [main]

jobs:
  deploy-react:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup Node
        uses: actions/setup-node@v3
        with:
          node-version: 18
      - name: Install and Build
        run: |
          cd react-app
          npm install
          npm run build
      - name: Deploy to Vercel
        uses: amondnet/vercel-action@v20
        with:
          vercel-token: ${{ secrets.VERCEL_TOKEN }}
          working-directory: ./react-app
```

## 📋 Deployment Checklist

### Pre-Deployment

- [ ] Local testing complete
- [ ] Build processes successful
- [ ] Environment variables configured
- [ ] Domain/hosting ready

### React Deployment

- [ ] `npm run build` successful
- [ ] Static files generated in `dist/`
- [ ] Routing configured for SPA
- [ ] Deployed and accessible

### Vue Deployment

- [ ] `npm run build` successful
- [ ] Static files generated in `dist/`
- [ ] Routing configured for SPA
- [ ] Deployed and accessible

### Twig Deployment

- [ ] HTML files ready for static hosting
- [ ] Navigation links updated for production
- [ ] Assets properly referenced
- [ ] Deployed and accessible

### Post-Deployment

- [ ] All deployments accessible
- [ ] Cross-framework data sharing works
- [ ] Performance acceptable
- [ ] Mobile responsiveness verified
- [ ] SEO meta tags present

## 🔗 Example Deployment URLs

Once deployed, your apps might be accessible at:

- **React**: `https://ticketapp-react.vercel.app`
- **Vue**: `https://ticketapp-vue.vercel.app`
- **Twig**: `https://username.github.io/ticketapp-twig`

## 🐛 Troubleshooting Deployment Issues

### Common Issues & Solutions

1. **Build Errors:**

   ```bash
   # Clear cache and rebuild
   rm -rf node_modules package-lock.json
   npm install
   npm run build
   ```

2. **Routing Issues (404s):**

   - Configure redirects for SPA routing
   - Ensure `index.html` fallback is set up

3. **Asset Loading Issues:**

   - Check base URL configuration
   - Verify relative/absolute paths

4. **Environment Variable Issues:**
   - Ensure variables start with `VITE_`
   - Check production environment configuration

---

This deployment guide ensures all three TicketApp implementations can be successfully deployed and accessed by users. Choose the deployment strategy that best fits your needs and infrastructure requirements.
