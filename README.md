**CC Clients Customizations Plugin**

**Description**
The CC Clients Customizations plugin enhances the management of the CC Clients post type within WordPress. It focuses on improving user experience by automating the generation of post titles based on custom field values. This plugin is especially useful for managing client information, invoices, and quotations efficiently.

**Features**
Automatic Post Titles for Clients
Automatically sets post titles for the CC Clients (cc_clientes) post type based on the 'nombre_cliente' custom field value.
Ensures that the post title always reflects the most up-to-date client name, enhancing the administrative workflow.

**Dynamic Invoice Titles
**Updates the titles of invoice posts (cc_invoices) dynamically to include client name, invoice number, date, and total amount.
Calculates the total invoice amount by summing up the line items, providing a comprehensive overview right in the post title.

**Automated Quotation Titles**
Automatically generates titles for quotation posts (cc_presupuestos) to include the client name and the date of the quotation.
Simplifies the management and identification of quotations, making it easier to track and organize them.

**Installation**
Download the plugin files and upload them to your WordPress site's wp-content/plugins directory.
Navigate to the WordPress admin area and go to the Plugins page.
Locate "CC Clients Customizations" in the plugin list and click the "Activate" button.

**Usage**
Once activated, the plugin works automatically. Here's what happens behind the scenes:

When a CC Client, Invoice, or Quotation post is saved, the plugin checks if the relevant custom fields are populated.
It then constructs a meaningful post title based on these fields and updates the post.
For invoices, it also calculates the total amount from line items and includes it in the post title.
No additional setup or interaction is required from the user end. The plugin streamlines the administrative process, allowing you to focus on more critical tasks.

**Developer**
Tarek Tarabichi
