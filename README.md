# SamJUK/php-duplicate-images

Source: https://github.com/SamJUK/php-duplicate-images

## Download
```bash
wget https://github.com/SamJUK/php-duplicate-images/archive/master.zip -O temp.zip \
    && unzip temp.zip \
    && rm temp.zip;
```

## Usage
### CLI Usage
**Manual**
```bash
cd ~/some/path/to/php-duplicate-images \
    && php shell.php ~/absolute/path/to/image1 ~/image2 ~/image3 /image4;
```
**Semi Automatic**

Instead of manually filling in the paths you can drop multiple images onto the terminal to automatically fill the absolute paths for them.
```bash
cd ~/some/path/to/php-duplicate-images \
    && php shell.php    
```