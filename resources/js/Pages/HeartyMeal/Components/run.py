
### Updated Python Script to Download Images and Update JSON

import requests
import json
import os
from urllib.parse import urlparse

def download_images_and_update_json(json_file, output_dir):
    # Create output directory if it doesn't exist
    os.makedirs(output_dir, exist_ok=True)

    with open(json_file, 'r') as f:
        data = json.load(f)

    for restaurant in data['restaurants']:
        # Download main image
        image_url = restaurant['image']
        main_image_filename = generate_filename(image_url, restaurant['id'], 'main')
        download_image(image_url, os.path.join(output_dir, main_image_filename))
        restaurant['image'] = main_image_filename  # Update the JSON with the new filename

        # Download cover image
        cover_url = restaurant['coverImage']
        cover_image_filename = generate_filename(cover_url, restaurant['id'], 'cover')
        download_image(cover_url, os.path.join(output_dir, cover_image_filename))
        restaurant['coverImage'] = cover_image_filename  # Update the JSON with the new filename

    # Write the updated data back to the JSON file
    with open(json_file, 'w') as f:
        json.dump(data, f, indent=4)

def generate_filename(url, restaurant_id, image_type):
    # Parse the URL to get the filename
    parsed_url = urlparse(url)
    filename = os.path.basename(parsed_url.path)  # Get the last part of the URL
    # Create a new filename with restaurant ID and image type
    new_filename = f"{restaurant_id}_{image_type}_{filename}"
    return new_filename

def download_image(url, filename):
    try:
        response = requests.get(url)
        response.raise_for_status()  # Raise an error for bad responses
        with open(filename, 'wb') as f:
            f.write(response.content)
        print(f"Downloaded: {filename}")
    except Exception as e:
        print(f"Failed to download {url}: {e}")

# Usage
download_images_and_update_json('restaurants.json', 'downloaded_images')
