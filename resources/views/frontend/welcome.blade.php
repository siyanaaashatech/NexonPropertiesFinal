@extends('frontend.layouts.master')

@section('content')

<!-- Search Form -->
<!-- Search Form -->
<!-- Search Form -->
<form action="{{ route('frontend.search') }}" method="GET">
    <input type="text" name="category_id" placeholder="Category ID" value="{{ request('category_id') }}">
    <input type="text" name="sub_category_id" placeholder="Sub-Category ID" value="{{ request('sub_category_id') }}">
    <input type="text" name="location" placeholder="Location" value="{{ request('location') }}">
    <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
    <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
    <input type="number" name="bedroom" placeholder="Bedrooms" value="{{ request('bedroom') }}">
    <button type="submit">Search</button>
</form>



<!-- Display the properties -->



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('searchForm');
        const propertiesContainer = document.getElementById('propertiesContainer');
        const noResultsMessage = document.getElementById('noResultsMessage');

        // Listen for form input changes
        form.addEventListener('input', filterProperties);

        function filterProperties() {
            const categoryId = document.getElementById('category_id').value.toLowerCase();
            const subCategoryId = document.getElementById('sub_category_id').value.toLowerCase();
            const location = document.getElementById('location').value.toLowerCase();
            const minPrice = parseFloat(document.getElementById('min_price').value) || 0;
            const maxPrice = parseFloat(document.getElementById('max_price').value) || Infinity;
            const bedrooms = parseInt(document.getElementById('bedroom').value) || 0;

            let items = propertiesContainer.getElementsByClassName('property-item');
            let itemsFound = false;

            for (let item of items) {
                // Extract data attributes from each property
                const itemCategoryId = item.getAttribute('data-category-id').toLowerCase();
                const itemSubCategoryId = item.getAttribute('data-sub-category-id').toLowerCase();
                const itemLocation = item.getAttribute('data-location').toLowerCase();
                const itemPrice = parseFloat(item.getAttribute('data-price'));
                const itemBedrooms = parseInt(item.getAttribute('data-bedrooms'));

                // Check if the property matches the input criteria
                const matchesCategory = categoryId === '' || itemCategoryId.includes(categoryId);
                const matchesSubCategory = subCategoryId === '' || itemSubCategoryId.includes(subCategoryId);
                const matchesLocation = location === '' || itemLocation.includes(location);
                const matchesPrice = itemPrice >= minPrice && itemPrice <= maxPrice;
                const matchesBedrooms = bedrooms === 0 || itemBedrooms === bedrooms;

                if (matchesCategory && matchesSubCategory && matchesLocation && matchesPrice && matchesBedrooms) {
                    item.style.display = 'block';
                    itemsFound = true;
                } else {
                    item.style.display = 'none';
                }
            }

            // Show or hide the no results message
            noResultsMessage.style.display = itemsFound ? 'none' : 'block';
        }
    });
</script>

@endsection
