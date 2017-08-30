# klf-tech-assessment
Technical Assessment project for KLF Media

# Wine List
I've made the list ordered by prodID in descending order. There's a hardcoded limit of 1000 records. Pagination is omitted.

There's a Modal to add a new products. The prodSoldOut, prodAvailable and prodPack fields are hardcoded values.

# Wine Product Page
Shows all relevant fields from the Products record.

# Suppliers & Regions
Only the dropdown menu is built and displayed. The template pages for suppliers and regions is omitted.

# API
Pull a JSON object via API call: http://localhost/api.php?product_id=[product_id] It's stripped down to only accept GET requests and only gets the product info via this request.
