import { createServer } from 'http';
import { readFile } from 'fs/promises';
import { join, extname } from 'path';
import { fileURLToPath } from 'url';
import { dirname } from 'path';
import { chromium } from 'playwright';

const __dirname = dirname(fileURLToPath(import.meta.url));
const themeDir = join(__dirname, '..');
const port = 8765;

const mime = {
  '.html': 'text/html',
  '.css': 'text/css',
  '.js': 'application/javascript',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
};

const server = createServer(async (req, res) => {
  try {
    const url = new URL(req.url, `http://127.0.0.1:${port}`);
    let filePath = join(themeDir, url.pathname === '/' ? 'screenshot-preview.html' : url.pathname);
    const data = await readFile(filePath);
    res.writeHead(200, { 'Content-Type': mime[extname(filePath)] || 'application/octet-stream' });
    res.end(data);
  } catch {
    res.writeHead(404);
    res.end('Not found');
  }
});

server.listen(port, async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage({ viewport: { width: 1440, height: 900 } });
  await page.goto(`http://127.0.0.1:${port}/screenshot-preview.html`, { waitUntil: 'networkidle', timeout: 60000 });
  await page.waitForTimeout(2000);

  const screenshotFull = join(themeDir, 'screenshot-full.png');
  await page.screenshot({ path: screenshotFull, fullPage: true });
  console.log('Saved full page:', screenshotFull);

  await page.setViewportSize({ width: 1200, height: 900 });
  await page.goto(`http://127.0.0.1:${port}/screenshot-preview.html`, { waitUntil: 'networkidle', timeout: 60000 });
  await page.waitForTimeout(1500);
  const screenshotPath = join(themeDir, 'screenshot.png');
  await page.screenshot({ path: screenshotPath, fullPage: false });
  console.log('Saved theme thumbnail:', screenshotPath);

  await browser.close();
  server.close();
});
