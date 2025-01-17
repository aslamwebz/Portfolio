import json
import os
import requests

# Load the JSON data
with open('foods.json', 'r') as file:
    data = json.load(file)

# Create the 'foods' directory if it doesn't exist
os.makedirs('foods', exist_ok=True)

# Iterate through restaurants and their menu items
for restaurant in data['restaurants']:
    for category in restaurant['menuCategories']:
        for item in category['items']:
            image_url = item['image']
            image_name = os.path.basename(image_url)  # Get the image name from the URL
            image_path = os.path.join('foods', image_name)

            # Download the image
            response = requests.get(image_url)
            if response.status_code == 200:
                with open(image_path, 'wb') as img_file:
                    img_file.write(response.content)
                # Update the item image name in the JSON data
                item['image'] = image_name  # Update to just the image name
            else:
                print(f"Failed to download {image_url}")

# Save the updated JSON data back to the file
with open('foods.json', 'w') as file:
    json.dump(data, file, indent=4)

print("Images downloaded and JSON updated successfully.")
