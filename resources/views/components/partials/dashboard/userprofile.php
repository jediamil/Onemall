<!-- {{-- resources/views/components/permit-uploader.blade.php --}} -->
<div class="max-w-4xl mx-auto p-6">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Permit Upload Center</h1>
        <p class="text-gray-600">Upload and manage your permits securely</p>
    </div>

    <!-- Upload Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <!-- Upload Area -->
        <div class="border-2 border-dashed border-teal-200 rounded-lg p-8 text-center transition-all duration-300 hover:border-teal-300 hover:bg-teal-50"
             id="dropZone">
            <!-- Icon -->
            <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-teal-600 text-2xl">
                    cloud_upload
                </span>
            </div>
            
            <!-- Text -->
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Upload Permit Files</h3>
            <p class="text-gray-600 mb-4">Drag & drop your files here or click to browse</p>
            
            <!-- Supported formats -->
            <div class="flex justify-center items-center space-x-4 text-sm text-gray-500 mb-4">
                <span class="flex items-center">
                    <span class="material-symbols-outlined text-teal-500 text-sm mr-1">
                        picture_as_pdf
                    </span>
                    PDF
                </span>
                <span class="flex items-center">
                    <span class="material-symbols-outlined text-teal-500 text-sm mr-1">
                        image
                    </span>
                    JPG, PNG
                </span>
                <span class="flex items-center">
                    <span class="material-symbols-outlined text-teal-500 text-sm mr-1">
                        description
                    </span>
                    DOC, DOCX
                </span>
            </div>
            
            <!-- Upload Button -->
            <label for="permit-file" class="cursor-pointer">
                <div class="inline-flex items-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <span class="material-symbols-outlined text-lg mr-2">
                        upload
                    </span>
                    Choose Files
                </div>
                <input type="file" id="permit-file" class="hidden" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
            </label>
        </div>

        <!-- Progress Bar (Hidden by default) -->
        <div id="uploadProgress" class="hidden mt-6">
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>Uploading...</span>
                <span id="progressPercent">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progressBar" class="bg-teal-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>
    </div>

    <!-- File List Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <!-- Section Header -->
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                <span class="material-symbols-outlined text-teal-600 mr-2">
                    folder
                </span>
                Uploaded Permits
                <span class="ml-2 bg-teal-100 text-teal-800 text-sm px-2 py-1 rounded-full">3 files</span>
            </h2>
        </div>

        <!-- File List -->
        <div class="divide-y divide-gray-200">
            <!-- File Item 1 -->
            <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors duration-150">
                <div class="flex items-center space-x-4">
                    <!-- File Icon -->
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-600">
                            picture_as_pdf
                        </span>
                    </div>
                    
                    <!-- File Info -->
                    <div>
                        <h3 class="font-medium text-gray-900">Building_Permit_2024.pdf</h3>
                        <p class="text-sm text-gray-500">2.4 MB • Uploaded on Jan 15, 2024</p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">Approved</span>
                    <button class="p-2 text-gray-400 hover:text-teal-600 transition-colors duration-150" title="Download">
                        <span class="material-symbols-outlined">download</span>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-red-600 transition-colors duration-150" title="Delete">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>

            <!-- File Item 2 -->
            <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors duration-150">
                <div class="flex items-center space-x-4">
                    <!-- File Icon -->
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600">
                            description
                        </span>
                    </div>
                    
                    <!-- File Info -->
                    <div>
                        <h3 class="font-medium text-gray-900">Construction_Plan.docx</h3>
                        <p class="text-sm text-gray-500">1.8 MB • Uploaded on Jan 14, 2024</p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-medium">Pending</span>
                    <button class="p-2 text-gray-400 hover:text-teal-600 transition-colors duration-150" title="Download">
                        <span class="material-symbols-outlined">download</span>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-red-600 transition-colors duration-150" title="Delete">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>

            <!-- File Item 3 -->
            <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors duration-150">
                <div class="flex items-center space-x-4">
                    <!-- File Icon -->
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-600">
                            image
                        </span>
                    </div>
                    
                    <!-- File Info -->
                    <div>
                        <h3 class="font-medium text-gray-900">Site_Photo_1.jpg</h3>
                        <p class="text-sm text-gray-500">3.1 MB • Uploaded on Jan 13, 2024</p>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex items-center space-x-2">
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-medium">Approved</span>
                    <button class="p-2 text-gray-400 hover:text-teal-600 transition-colors duration-150" title="Download">
                        <span class="material-symbols-outlined">download</span>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-red-600 transition-colors duration-150" title="Delete">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="hidden px-6 py-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-gray-400 text-2xl">
                    folder_open
                </span>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No permits uploaded yet</h3>
            <p class="text-gray-500 mb-4">Upload your first permit to get started</p>
        </div>
    </div>
</div>

<!-- Include Material Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />