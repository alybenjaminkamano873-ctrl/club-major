from PIL import Image, ImageDraw, ImageFont
import os

# Create a new image with a gradient background
width = 600
height = 400
image = Image.new('RGB', (width, height), color='white')
draw = ImageDraw.Draw(image)

# Colors
dark_green = (34, 139, 34)
light_green = (144, 238, 144)
blue = (30, 144, 255)
black = (0, 0, 0)

# Draw border
draw.rectangle([(5, 5), (width-5, height-5)], outline=dark_green, width=3)
draw.rectangle([(10, 10), (width-10, height-10)], outline=light_green, width=2)

# Draw diagonal lines
for i in range(0, width, 40):
    draw.line([(i, 0), (i+100, height)], fill=light_green, width=2)

# Add text
try:
    # Try to use a TrueType font if available
    font_large = ImageFont.truetype("arial.ttf", 72)
    font_medium = ImageFont.truetype("arial.ttf", 36)
    font_small = ImageFont.truetype("arial.ttf", 24)
except:
    # Use default font
    font_large = ImageFont.load_default()
    font_medium = ImageFont.load_default()
    font_small = ImageFont.load_default()

# Draw text
draw.text((150, 80), "MAJOR", fill=dark_green, font=font_large)
draw.text((60, 200), "Mazagan Athletisme", fill=blue, font=font_medium)
draw.text((80, 280), "Jogging And Organisation", fill=black, font=font_small)

# Save the image
output_path = os.path.join(os.path.dirname(__file__), 'assets', 'images', 'logo_major.png')
os.makedirs(os.path.dirname(output_path), exist_ok=True)
image.save(output_path)

print(f"Logo created successfully at: {output_path}")
