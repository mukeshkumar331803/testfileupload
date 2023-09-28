<!DOCTYPE html>
<html>
<head>
    <title>Document Management</title>
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Document Scanning and Keyword Search</h1>

        <!--Upload fiels -->
        <div class="mb-4">
            <h2>Upload a Document</h2>
            <form id="uploadForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Document Title">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="file" class="form-control-file" name="file">
                    @error('file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Upload additional evidence</button>
            </form>
        </div>

        <!-- Searching keywords -->
        <div>
            <h2>Search for Documents</h2>
            <form id="searchForm">
                <div class="form-group">
                    <input type="text" class="form-control" id="searchKeyword" placeholder="Search for documents">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <div id="searchResults" class="mt-3">
                <!-- Scanned document file results -->
            </div>
        </div>

        <!-- Document file previews -->
        <div id="documentPreview" class="mt-3">
            <!-- Document file here -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var assetBaseUrl = "{{ asset('') }}";
    </script>
    <script src="{{asset('js/index.js')}}"></script>

</body>
</html>
