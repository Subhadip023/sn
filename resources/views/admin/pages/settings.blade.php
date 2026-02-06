<x-admin-layout title="Page Settings">
    <header class="flex flex-wrap items-center gap-4 justify-between mb-6">
        <div>
            <p class="text-sm text-slate-500">Site</p>
            <h1 class="text-2xl font-semibold text-slate-900">Page Settings</h1>
        </div>
        <div class="flex items-center gap-3">
            <a class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium transition-colors" href="{{ route('pages.index') }}">Back</a>
            <a class="px-4 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold transition-colors" href="{{ route('pages.create') }}">Create Page</a>
        </div>
    </header>

    <form action="{{ route('page.settings.update') }}" method="post" id="settting_form">
        <input type="hidden" name="page_id" value="{{ $page->id }}">
        @csrf
        
        <!-- Hidden inputs for selected categories -->
        @if(isset($categories) && count($selcted_categories) > 0)
            @foreach($categories as $cat)
                @if(in_array($cat->id, $selcted_categories))
                    <input type="hidden" name="categories[]" value="{{ $cat->id }}">
                @endif
            @endforeach
        @endif
        
        <!-- Hidden inputs for selected tags -->
        @if(isset($tags) && count($selcted_tags) > 0)
            @foreach($tags as $tag)
                @if(in_array($tag->id, $selcted_tags))
                    <input type="hidden" name="tags[]" value="{{ $tag->id }}">
                @endif
            @endforeach
        @endif
        
        <section class="rounded-xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="grid md:grid-cols-2 divide-x divide-slate-200">
                <!-- Categories Section -->
                <div class="p-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-slate-900">Categories</h2>
                        <p class="text-sm text-slate-500 mt-1">Select applicable categories</p>
                    </div>
                    
                    <!-- Selected Categories -->
                    <div class="selcted_cats mb-4 min-h-[40px] p-3 rounded-lg border border-slate-200 bg-slate-50 flex flex-wrap gap-2">
                        @if(isset($categories) && count($selcted_categories) > 0)
                            @foreach($categories as $cat)
                                @if(!in_array($cat->id, $selcted_categories)) @continue; @endif
                               <span class="selected-cat inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-100 text-brand-700 text-sm font-medium" data-id="{{ $cat->id }}">
                                {{ $cat->title }}
                                <button type="button" class="remove-cat hover:bg-brand-200 rounded-full p-0.5 transition-colors" data-id="{{ $cat->id }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </span>
                            @endforeach
                        @else
                            <span class="text-xs text-slate-400 italic empty-message">No categories selected</span>
                        @endif
                    </div>
                    
                    <!-- Search Input -->
                    <div class="mb-4"> 
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="search" name="search_catgory" value="" id="search_catgory_input" placeholder="Search categories..." class="w-full rounded-lg border border-slate-300 bg-white pl-10 pr-4 py-2.5 text-sm text-slate-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 focus:outline-none transition-all">
                        </div>
                    </div>
                    
                    <!-- Available Categories -->
                    <div class="catgories_div space-y-2 max-h-[300px] overflow-y-auto">
                        <p class="text-xs text-slate-400 italic">Start typing to search categories...</p>
                    </div>
                </div>

                <!-- Tags Section -->
                <div class="p-8">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-slate-900">Tags</h2>
                        <p class="text-sm text-slate-500 mt-1">Select relevant tags</p>
                    </div>
                    
                    <!-- Selected Tags -->
                    <div class="selcted_tags mb-4 min-h-[40px] p-3 rounded-lg border border-slate-200 bg-slate-50 flex flex-wrap gap-2">
                        @if(isset($tags) && count($selcted_tags) > 0)
                            @foreach($tags as $tag)
                                @if(!in_array($tag->id, $selcted_tags)) @continue; @endif
                               <span class="selected-tag inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-100 text-brand-700 text-sm font-medium" data-id="{{ $tag->id }}">
                                {{ $tag->title }}
                                <button type="button" class="remove-tag hover:bg-brand-200 rounded-full p-0.5 transition-colors" data-id="{{ $tag->id }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </span>
                            @endforeach
                        @else
                            <span class="text-xs text-slate-400 italic empty-message">No tags selected</span>
                        @endif
                    </div>
                    
                    <!-- Search Input -->
                    <div class="mb-4"> 
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="search" name="search_tag" value="" id="search_tag_input" placeholder="Search tags..." class="w-full rounded-lg border border-slate-300 bg-white pl-10 pr-4 py-2.5 text-sm text-slate-900 focus:border-brand-500 focus:ring-2 focus:ring-brand-200 focus:outline-none transition-all">
                        </div>
                    </div>
                    
                    <!-- Available Tags -->
                    <div class="tags_div space-y-2 max-h-[300px] overflow-y-auto">
                        <p class="text-xs text-slate-400 italic">Start typing to search tags...</p>
                    </div>
                </div>
            </div>

            <!-- Footer with Save Button -->
            <div class="border-t border-slate-200 bg-slate-50 px-8 py-4">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-slate-500">Save your changes to update page settings</p>
                    <button type="submit" class="px-6 py-2 rounded-lg bg-brand-500 hover:bg-brand-400 text-white font-semibold transition-colors">
                        Save Settings
                    </button>
                </div>
            </div>
        </section>
    </form>
</x-admin-layout>

<script>
    let currentFocusIndex = -1;
    let searchTimeout = null;

    $(document).on('keyup', '#search_catgory_input', function(e) {
        // Ignore arrow keys and enter for navigation
        if([38, 40, 13].includes(e.keyCode)) {
            return;
        }
        
        let query = $(this).val();

        // Clear previous timeout
        if(searchTimeout) {
            clearTimeout(searchTimeout);
        }

        // Only search if query has at least 1 character
        if(query.length === 0) {
            $('.catgories_div').html('<p class="text-xs text-slate-400 italic">Start typing to search categories...</p>');
            return;
        }

        // Debounce: wait 300ms after user stops typing
        searchTimeout = setTimeout(function() {
            $.ajax({
                url: "{{ route('categories.search') }}",
                method: 'POST',
                data: {
                    query: query,
                    _token: '{{ csrf_token() }}'
                },
                
                success: function(response) {
                   if(response.success) {
                    let html='';
                    if(response.data.length > 0) {
                        response.data.forEach(element => {
                            html += `<button type="button" class="cat_button w-full text-left px-4 py-2.5 rounded-lg border border-slate-200 bg-white hover:bg-brand-50 hover:border-brand-300 focus:bg-brand-50 focus:border-brand-400 focus:ring-2 focus:ring-brand-200 transition-all group outline-none" data-name="${element.title}" data-id="${element.id}">
                                <span class="text-sm text-slate-700 group-hover:text-brand-600 group-focus:text-brand-600 font-medium">${element.title}</span>
                            </button>`;
                        });
                    } else {
                        html = '<p class="text-xs text-slate-400 italic">No categories found</p>';
                    }
                    $('.catgories_div').html(html);
                    currentFocusIndex = -1; // Reset focus index
                   }
                }
            });
        }, 500); // Wait 300ms after user stops typing
        
        });

        // Keyboard navigation for search input
        $(document).on('keydown', '#search_catgory_input', function(e) {
            const buttons = $('.cat_button');
            
            if(buttons.length === 0) return;
            
            // Down arrow - move to first item or next item
            if(e.keyCode === 40) {
                e.preventDefault();
                if(currentFocusIndex < buttons.length - 1) {
                    currentFocusIndex++;
                    buttons.eq(currentFocusIndex).focus();
                }
            }
            // Up arrow - move to previous item
            else if(e.keyCode === 38) {
                e.preventDefault();
                if(currentFocusIndex > 0) {
                    currentFocusIndex--;
                    buttons.eq(currentFocusIndex).focus();
                }
            }
        });

        // Keyboard navigation for category buttons
        $(document).on('keydown', '.cat_button', function(e) {
            const buttons = $('.cat_button');
            currentFocusIndex = buttons.index(this);
            
            // Down arrow - move to next item
            if(e.keyCode === 40) {
                e.preventDefault();
                if(currentFocusIndex < buttons.length - 1) {
                    currentFocusIndex++;
                    buttons.eq(currentFocusIndex).focus();
                }
            }
            // Up arrow - move to previous item
            else if(e.keyCode === 38) {
                e.preventDefault();
                if(currentFocusIndex > 0) {
                    currentFocusIndex--;
                    buttons.eq(currentFocusIndex).focus();
                } else {
                    // Go back to search input
                    $('#search_catgory_input').focus();
                    currentFocusIndex = -1;
                }
            }
            // Enter - select category
            else if(e.keyCode === 13) {
                e.preventDefault();
                $(this).click();
            }
            // Escape - go back to search input
            else if(e.keyCode === 27) {
                e.preventDefault();
                $('#search_catgory_input').focus();
                currentFocusIndex = -1;
            }
        });

        $(document).on('click', '.cat_button', function(e) {
            e.preventDefault();
            let selected = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            
            // Check if already selected
            if($(`input[name="categories[]"][value="${selected}"]`).length > 0) {
                return;
            }
            
            // Hide empty message
            $('.selcted_cats .empty-message').hide();
            
            // Add selected category badge
            $('.selcted_cats').append(`
                <span class="selected-cat inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-100 text-brand-700 text-sm font-medium" data-id="${selected}">
                    ${name}
                    <button type="button" class="remove-cat hover:bg-brand-200 rounded-full p-0.5 transition-colors" data-id="${selected}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </span>
            `);
            
            // Add hidden input
            $('#settting_form').append(`<input type="hidden" name="categories[]" value="${selected}">`);
            
            // Remove from available list
            $(this).remove();
        });
        
        // Remove selected category
        $(document).on('click', '.remove-cat', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            
            // Remove badge
            $(`.selected-cat[data-id="${id}"]`).remove();
            
            // Remove hidden input
            $(`input[name="categories[]"][value="${id}"]`).remove();
            
            // Show empty message if no categories selected
            if($('.selected-cat').length === 0) {
                $('.selcted_cats .empty-message').show();
            }
            
            // Clear search to allow re-searching
            $('#search_catgory_input').val('');
            $('.catgories_div').html('<p class="text-xs text-slate-400 italic">Start typing to search categories...</p>');
        });

    // Tags Search Functionality
    let currentTagFocusIndex = -1;
    let tagSearchTimeout = null;

    $(document).on('keyup', '#search_tag_input', function(e) {
        // Ignore arrow keys and enter for navigation
        if([38, 40, 13].includes(e.keyCode)) {
            return;
        }
        
        let query = $(this).val();

        // Clear previous timeout
        if(tagSearchTimeout) {
            clearTimeout(tagSearchTimeout);
        }

        // Only search if query has at least 1 character
        if(query.length === 0) {
            $('.tags_div').html('<p class="text-xs text-slate-400 italic">Start typing to search tags...</p>');
            return;
        }

        // Debounce: wait 500ms after user stops typing
        tagSearchTimeout = setTimeout(function() {
            $.ajax({
                url: "{{ route('tags.search') }}",
                method: 'POST',
                data: {
                    query: query,
                    _token: '{{ csrf_token() }}'
                },
                
                success: function(response) {
                   if(response.success) {
                    let html='';
                    if(response.data.length > 0) {
                        response.data.forEach(element => {
                            html += `<button type="button" class="tag_button w-full text-left px-4 py-2.5 rounded-lg border border-slate-200 bg-white hover:bg-brand-50 hover:border-brand-300 focus:bg-brand-50 focus:border-brand-400 focus:ring-2 focus:ring-brand-200 transition-all group outline-none" data-name="${element.title}" data-id="${element.id}">
                                <span class="text-sm text-slate-700 group-hover:text-brand-600 group-focus:text-brand-600 font-medium">${element.title}</span>
                            </button>`;
                        });
                    } else {
                        html = '<p class="text-xs text-slate-400 italic">No tags found</p>';
                    }
                    $('.tags_div').html(html);
                    currentTagFocusIndex = -1; // Reset focus index
                   }
                }
            });
        }, 500); // Wait 500ms after user stops typing
        
        });

        // Keyboard navigation for tag search input
        $(document).on('keydown', '#search_tag_input', function(e) {
            const buttons = $('.tag_button');
            
            if(buttons.length === 0) return;
            
            // Down arrow - move to first item or next item
            if(e.keyCode === 40) {
                e.preventDefault();
                if(currentTagFocusIndex < buttons.length - 1) {
                    currentTagFocusIndex++;
                    buttons.eq(currentTagFocusIndex).focus();
                }
            }
            // Up arrow - move to previous item
            else if(e.keyCode === 38) {
                e.preventDefault();
                if(currentTagFocusIndex > 0) {
                    currentTagFocusIndex--;
                    buttons.eq(currentTagFocusIndex).focus();
                }
            }
        });

        // Keyboard navigation for tag buttons
        $(document).on('keydown', '.tag_button', function(e) {
            const buttons = $('.tag_button');
            currentTagFocusIndex = buttons.index(this);
            
            // Down arrow - move to next item
            if(e.keyCode === 40) {
                e.preventDefault();
                if(currentTagFocusIndex < buttons.length - 1) {
                    currentTagFocusIndex++;
                    buttons.eq(currentTagFocusIndex).focus();
                }
            }
            // Up arrow - move to previous item
            else if(e.keyCode === 38) {
                e.preventDefault();
                if(currentTagFocusIndex > 0) {
                    currentTagFocusIndex--;
                    buttons.eq(currentTagFocusIndex).focus();
                } else {
                    // Go back to search input
                    $('#search_tag_input').focus();
                    currentTagFocusIndex = -1;
                }
            }
            // Enter - select tag
            else if(e.keyCode === 13) {
                e.preventDefault();
                $(this).click();
            }
            // Escape - go back to search input
            else if(e.keyCode === 27) {
                e.preventDefault();
                $('#search_tag_input').focus();
                currentTagFocusIndex = -1;
            }
        });

        $(document).on('click', '.tag_button', function(e) {
            e.preventDefault();
            let selected = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            
            // Check if already selected
            if($(`input[name="tags[]"][value="${selected}"]`).length > 0) {
                return;
            }
            
            // Hide empty message
            $('.selcted_tags .empty-message').hide();
            
            // Add selected tag badge
            $('.selcted_tags').append(`
                <span class="selected-tag inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-brand-100 text-brand-700 text-sm font-medium" data-id="${selected}">
                    ${name}
                    <button type="button" class="remove-tag hover:bg-brand-200 rounded-full p-0.5 transition-colors" data-id="${selected}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </span>
            `);
            
            // Add hidden input
            $('#settting_form').append(`<input type="hidden" name="tags[]" value="${selected}">`);
            
            // Remove from available list
            $(this).remove();
        });
        
        // Remove selected tag
        $(document).on('click', '.remove-tag', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            
            // Remove badge
            $(`.selected-tag[data-id="${id}"]`).remove();
            
            // Remove hidden input
            $(`input[name="tags[]"][value="${id}"]`).remove();
            
            // Show empty message if no tags selected
            if($('.selected-tag').length === 0) {
                $('.selcted_tags .empty-message').show();
            }
            
            // Clear search to allow re-searching
            $('#search_tag_input').val('');
            $('.tags_div').html('<p class="text-xs text-slate-400 italic">Start typing to search tags...</p>');
        });
</script>