<x-admin-layout>
        <header class="flex flex-wrap items-center gap-4 justify-between">
          <div>
            <p class="text-sm text-slate-500">Content</p>
            <h1 class="text-2xl font-semibold text-slate-900">Manage articles</h1>
          </div>
          <div class="flex items-center gap-3">
            <button id="themeBtn" class="px-4 py-2 rounded-lg border border-slate-200 hover:border-slate-300 text-slate-700">Theme</button>
            <a class="px-4 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white font-semibold" href="#newArticleForm">New article</a>
          </div>
        </header>

        <section class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <input class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none" type="search" placeholder="Search title or author" />
              <select class="rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-900 focus:border-brand-500 focus:outline-none">
                <option>All sections</option>
                <option>World</option>
                <option>Tech</option>
                <option>Business</option>
              </select>
            </div>
            <span class="text-sm text-slate-500">482 items</span>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead class="text-slate-500">
                <tr class="text-left">
                  <th class="py-2 font-medium">Title</th>
                  <th class="py-2 font-medium">Section</th>
                  <th class="py-2 font-medium">Status</th>
                  <th class="py-2 font-medium">Updated</th>
                  <th class="py-2 font-medium">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100">
                <tr>
                  <td class="py-2 text-slate-900">AI safety pact sets disclosure rules</td>
                  <td class="py-2 text-slate-600">Tech</td>
                  <td class="py-2"><span class="px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-medium">Published</span></td>
                  <td class="py-2 text-slate-500">10:04</td>
                  <td class="py-2 space-x-2">
                    <a class="text-brand-600 hover:text-brand-700" href="./article.html">View</a>
                    <button class="text-slate-500 hover:text-slate-700">Edit</button>
                  </td>
                </tr>
                <tr>
                  <td class="py-2 text-slate-900">Streaming bundles return</td>
                  <td class="py-2 text-slate-600">Culture</td>
                  <td class="py-2"><span class="px-2 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-medium">Draft</span></td>
                  <td class="py-2 text-slate-500">09:40</td>
                  <td class="py-2 space-x-2">
                    <a class="text-brand-600 hover:text-brand-700" href="./article.html">View</a>
                    <button class="text-slate-500 hover:text-slate-700">Edit</button>
                  </td>
                </tr>
                <tr>
                  <td class="py-2 text-slate-900">Microgrids accelerate recovery</td>
                  <td class="py-2 text-slate-600">Climate</td>
                  <td class="py-2"><span class="px-2 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-medium">Review</span></td>
                  <td class="py-2 text-slate-500">09:12</td>
                  <td class="py-2 space-x-2">
                    <a class="text-brand-600 hover:text-brand-700" href="./article.html">View</a>
                    <button class="text-slate-500 hover:text-slate-700">Edit</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        <section id="newArticleForm" class="rounded-xl border border-slate-200 bg-white p-5 space-y-4 shadow-sm">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-slate-900">New article</h2>
            <span class="text-sm text-slate-500">Draft</span>
          </div>
          
          <!-- SEO Section -->
          <div class="space-y-4 p-4 bg-slate-50 rounded-lg border border-slate-200">
            <h3 class="font-medium text-brand-600">SEO Settings</h3>
            
            <!-- Meta Title -->
            <div>
              <label for="metaTitle" class="block text-sm font-medium mb-1 text-slate-700">Meta Title</label>
              <input type="text" id="metaTitle" name="metaTitle" maxlength="60" 
                     class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"
                     placeholder="Keep it under 60 characters">
              <p class="mt-1 text-xs text-slate-500">Recommended: 50-60 characters</p>
            </div>
            
            <!-- Meta Description -->
            <div>
              <label for="metaDescription" class="block text-sm font-medium mb-1 text-slate-700">Meta Description</label>
              <textarea id="metaDescription" name="metaDescription" rows="2" maxlength="160"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"
                        placeholder="A brief summary of the article for search results"></textarea>
              <p class="mt-1 text-xs text-slate-500">Recommended: 120-160 characters</p>
            </div>
            
            <!-- URL Slug -->
            <div>
              <label for="urlSlug" class="block text-sm font-medium mb-1 text-slate-700">URL Slug</label>
              <div class="flex">
                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-slate-300 bg-slate-100 text-slate-500 text-sm">
                  https://example.com/article/
                </span>
                <input type="text" id="urlSlug" name="urlSlug" 
                       class="flex-1 min-w-0 block w-full rounded-none rounded-r-lg border border-slate-300 bg-white px-4 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"
                       placeholder="article-url-slug" pattern="[a-z0-9]+(?:-[a-z0-9]+)*">
              </div>
              <p class="mt-1 text-xs text-slate-500">Use lowercase letters, numbers, and hyphens only</p>
            </div>
          </div>
          <form class="grid md:grid-cols-2 gap-4" id="newArticle">
            <div class="space-y-2 md:col-span-2">
              <label for="headline" class="block text-sm font-medium text-slate-700">Headline</label>
              <textarea id="headline" name="headline" rows="2" required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"
                        placeholder="Enter article headline"></textarea>
            </div>
            <label class="space-y-2">
              <span class="text-sm text-slate-700">Section</span>
              <select class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 focus:border-brand-500 focus:outline-none" required name="section">
                <option>World</option>
                <option>Tech</option>
                <option>Business</option>
                <option>Climate</option>
                <option>Culture</option>
              </select>
            </label>
            <div class="space-y-2 md:col-span-2">
              <label for="summary" class="block text-sm font-medium text-slate-700">Summary</label>
              <textarea id="summary" name="summary" rows="4" required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"
                        placeholder="Enter article summary"></textarea>
            </div>
            <div class="space-y-2 md:col-span-2">
              <label for="body" class="block text-sm font-medium text-slate-700">Body</label>
              <textarea id="body" name="body" rows="8" required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-900 placeholder:text-slate-400 focus:border-brand-500 focus:outline-none"
                        placeholder="Write your article content here"></textarea>
            </div>
            <div class="flex items-center gap-3 md:col-span-2">
              <button class="px-4 py-2 rounded-lg bg-brand-600 hover:bg-brand-500 text-white font-semibold" type="submit">Save draft</button>
              <button class="px-4 py-2 rounded-lg border border-slate-300 hover:border-slate-400 text-slate-700" type="button">Preview</button>
              <p class="text-sm text-emerald-600" id="newArticleHint" role="status" aria-live="polite"></p>
            </div>
          </form>
        </section>
</x-admin-layout>
