 <!-- Subscription Popup -->
    <div id="subscriptionPopup" class="popup-overlay fixed inset-0 bg-black/70 flex justify-center items-center z-[1000] opacity-0 invisible transition-all duration-300">
        
        <div class="popup-content bg-white rounded-lg w-[90%] max-w-md p-8 relative transform -translate-y-12 transition-transform duration-300">
            <button class="close-popup absolute top-4 right-5 text-2xl bg-transparent border-none cursor-pointer text-gray-600 hover:text-primary-red transition-colors">&times;</button>
            <div class="text-center">
                <h3 class="text-2xl text-gray-800 mb-4 flex items-center justify-center gap-2.5"><i class="fas fa-envelope-open-text text-primary-red"></i> Subscribe to Our Newsletter</h3>
                <p class="text-gray-600 mb-6">Get the latest news and updates delivered to your inbox daily.</p>
                <form id="subscriptionForm" class="text-left" action="{{ route('news-later.store') }}" method="POST">
                    @csrf
                    <div class="mb-5 flex gap-2.5">
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required class="flex-1 px-4 py-3 border border-gray-300 rounded focus:border-primary-blue focus:outline-none focus:ring-2 focus:ring-primary-blue/20">
                        <button type="submit" class="bg-gradient-to-br from-primary-red to-[#c41230] text-white px-6 py-3 rounded font-semibold cursor-pointer hover:from-[#c41230] hover:to-[#a30e28] hover:-translate-y-0.5 transition-all whitespace-nowrap">Subscribe</button>
                    </div>
                    <div class="mt-5">
                        <label class="flex items-center text-gray-600 text-sm cursor-pointer relative pl-8 select-none">
                            <input type="checkbox" id="terms" name="is_active" value="1" required class="absolute opacity-0 cursor-pointer h-0 w-0">
                            <span class="absolute left-0 top-0 h-5 w-5 bg-gray-100 border border-gray-300 rounded transition-all checkbox-checkmark"></span>
                            I agree to the <a href="#" class="text-primary-blue font-medium hover:text-primary-red hover:underline ml-1">Terms & Conditions</a>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>