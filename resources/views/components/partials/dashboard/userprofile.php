<!-- Add this in your head section -->


<div class="max-w-4xl mx-auto p-6">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Permit Upload Center</h1>
        <p class="text-gray-600">Upload and manage your permits securely</p>
    </div>

    <!-- Upload Card -->
    <div class="bg-cyan-50 rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <!-- Upload Form -->
        <form id="uploadForm">
            
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

            <!-- Selected Files Preview -->
            <div id="selectedFiles" class="hidden mt-6">
                <h4 class="font-medium text-gray-900 mb-3">Selected Files:</h4>
                <div id="fileList" class="space-y-2 max-h-60 overflow-y-auto"></div>
                <button type="button" id="uploadButton" class="w-full mt-4 px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <span class="material-symbols-outlined text-lg mr-2">
                        cloud_upload
                    </span>
                    Upload Files
                </button>
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
        </form>

        <!-- Upload Results -->
        <div id="uploadResults" class="hidden mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-green-600 mr-2">check_circle</span>
                <h4 class="font-medium text-green-800">Files uploaded successfully!</h4>
            </div>
            <div id="fileUrls" class="mt-2 space-y-2"></div>
        </div>
    </div>
</div>

<!-- Include Material Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('permit-file');
    const selectedFiles = document.getElementById('selectedFiles');
    const fileList = document.getElementById('fileList');
    const uploadButton = document.getElementById('uploadButton');
    const uploadProgress = document.getElementById('uploadProgress');
    const progressBar = document.getElementById('progressBar');
    const progressPercent = document.getElementById('progressPercent');
    const uploadResults = document.getElementById('uploadResults');
    const fileUrls = document.getElementById('fileUrls');

    let selectedFilesArray = [];

    // Get CSRF token
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
               document.querySelector('input[name="_token"]')?.value;
    }

    // File selection handler
    fileInput.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });

    // Drag and drop handlers
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dropZone.classList.add('border-teal-400', 'bg-teal-50');
    }

    function unhighlight() {
        dropZone.classList.remove('border-teal-400', 'bg-teal-50');
    }

    dropZone.addEventListener('drop', function(e) {
        const files = e.dataTransfer.files;
        fileInput.files = files; // Update the actual file input
        handleFiles(files);
    });

    function handleFiles(files) {
        if (files.length > 0) {
            selectedFilesArray = Array.from(files);
            updateFileList();
            selectedFiles.classList.remove('hidden');
        }
    }

    function updateFileList() {
        fileList.innerHTML = '';
        
        selectedFilesArray.forEach((file, index) => {
            const fileItem = document.createElement('div');
            fileItem.className = 'flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200 shadow-sm';
            fileItem.innerHTML = `
                <div class="flex items-center space-x-3">
                    <span class="material-symbols-outlined text-teal-500">
                        ${getFileIcon(file.type)}
                    </span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">${file.name}</p>
                        <p class="text-xs text-gray-500">${formatFileSize(file.size)} • ${file.type}</p>
                    </div>
                </div>
                <button type="button" onclick="removeFile(${index})" class="text-red-400 hover:text-red-600 transition-colors">
                    <span class="material-symbols-outlined text-sm">delete</span>
                </button>
            `;
            fileList.appendChild(fileItem);
        });
    }

    function getFileIcon(fileType) {
        if (fileType.includes('pdf')) return 'picture_as_pdf';
        if (fileType.includes('image')) return 'image';
        if (fileType.includes('word') || fileType.includes('document')) return 'description';
        return 'insert_drive_file';
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    window.removeFile = function(index) {
        selectedFilesArray.splice(index, 1);
        
        // Also update the file input
        const dt = new DataTransfer();
        selectedFilesArray.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
        
        if (selectedFilesArray.length === 0) {
            selectedFiles.classList.add('hidden');
        } else {
            updateFileList();
        }
    };

    // Upload button click handler
    uploadButton.addEventListener('click', async function(e) {
        e.preventDefault();
        
        if (selectedFilesArray.length === 0) {
            showError('Please select files to upload');
            return;
        }
        
        uploadButton.disabled = true;
        uploadButton.innerHTML = '<span class="material-symbols-outlined text-lg mr-2">hourglass_empty</span>Uploading...';
        uploadProgress.classList.remove('hidden');
        uploadResults.classList.add('hidden');
        
        const formData = new FormData();
        const csrfToken = getCsrfToken();
        
        // Add CSRF token to FormData
        formData.append('_token', csrfToken);
        
        // CORRECTED: Add files to FormData using the file input
        // This ensures files are properly attached
        for (let i = 0; i < fileInput.files.length; i++) {
            formData.append('permit_files[]', fileInput.files[i]);
        }

        // Debug: Log what we're sending
        console.log('Sending files:', selectedFilesArray.map(f => f.name));
        console.log('FormData files:', fileInput.files.length);

        try {
            // Show progress animation
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += 2;
                if (progress > 80) progress = 80;
                progressBar.style.width = progress + '%';
                progressPercent.textContent = Math.round(progress) + '%';
            }, 100);

            // Make the upload request
            const response = await fetch('/permits/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                    // Don't set Content-Type for FormData - let browser set it with boundary
                }
            });

            clearInterval(progressInterval);
            
            if (!response.ok) {
                if (response.status === 419) {
                    throw new Error('Session expired. Please refresh the page and try again.');
                } else if (response.status === 422) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Validation failed');
                } else {
                    throw new Error(`Server error: ${response.status}`);
                }
            }
            
            const result = await response.json();
            
            if (result.success) {
                // Complete progress bar
                progressBar.style.width = '100%';
                progressPercent.textContent = '100%';
                
                // Show success results
                showUploadResults(result.files);
                
                // Reset form after delay
                setTimeout(() => {
                    resetUploadForm();
                }, 5000);
            } else {
                throw new Error(result.message || 'Upload failed');
            }
            
        } catch (error) {
            console.error('Upload error:', error);
            showError(error.message);
            resetUploadButton();
            uploadProgress.classList.add('hidden');
        }
    });

    function showUploadResults(files) {
        fileUrls.innerHTML = '';
        
        files.forEach(file => {
            const urlItem = document.createElement('div');
            urlItem.className = 'flex items-center justify-between p-3 bg-white rounded border border-green-200';
            urlItem.innerHTML = `
                <div class="flex items-center space-x-3 flex-1 min-w-0">
                    <span class="material-symbols-outlined text-teal-500">${getFileIcon('.' + file.file_type)}</span>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">${file.original_name}</p>
                        <p class="text-xs text-gray-500">${formatFileSize(file.file_size)} • ${file.file_type}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="${file.url}" target="_blank" class="text-teal-600 hover:text-teal-800 text-sm font-medium whitespace-nowrap px-3 py-1 rounded border border-teal-200 hover:bg-teal-50 flex items-center">
                        <span class="material-symbols-outlined text-sm mr-1">visibility</span>
                        View
                    </a>
                    <button onclick="copyToClipboard('${file.url}')" class="text-gray-600 hover:text-gray-800 text-sm font-medium whitespace-nowrap px-3 py-1 rounded border border-gray-200 hover:bg-gray-50 flex items-center">
                        <span class="material-symbols-outlined text-sm mr-1">link</span>
                        Copy URL
                    </button>
                </div>
            `;
            fileUrls.appendChild(urlItem);
        });
        
        uploadResults.classList.remove('hidden');
    }

    function resetUploadForm() {
        fileInput.value = '';
        selectedFilesArray = [];
        selectedFiles.classList.add('hidden');
        uploadProgress.classList.add('hidden');
        resetUploadButton();
        progressBar.style.width = '0%';
        progressPercent.textContent = '0%';
    }

    function resetUploadButton() {
        uploadButton.disabled = false;
        uploadButton.innerHTML = '<span class="material-symbols-outlined text-lg mr-2">cloud_upload</span>Upload Files';
    }

    function showError(message) {
        // Remove any existing error messages
        const existingErrors = document.querySelectorAll('.error-message');
        existingErrors.forEach(error => error.remove());
        
        // Create error notification
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message mt-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-center';
        errorDiv.innerHTML = `
            <span class="material-symbols-outlined text-red-600 mr-2">error</span>
            <span class="text-red-800 text-sm">${message}</span>
        `;
        
        const uploadCard = document.querySelector('.bg-cyan-50');
        uploadCard.appendChild(errorDiv);
        
        setTimeout(() => errorDiv.remove(), 5000);
    }

    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(() => {
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Copied!';
            button.classList.remove('text-gray-600', 'hover:text-gray-800');
            button.classList.add('text-green-600');
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('text-green-600');
                button.classList.add('text-gray-600', 'hover:text-gray-800');
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    };
});
</script>