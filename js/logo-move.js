const imageContainer = document.getElementById('image-container');
const image1 = document.getElementById('image1');
const image2 = document.getElementById('image2');
const image3 = document.getElementById('image3');

// 1-2-3-2
imageContainer.addEventListener('mouseover', async () => {
    image1.style.opacity = '0';
    image2.style.opacity = '1';
    await delay(300);
    image2.style.opacity = '0';
    image3.style.opacity = '1';
    await delay(300);
    image3.style.opacity = '0';
    image2.style.opacity = '1';
    await delay(300);
    image2.style.opacity = '0';
    image3.style.opacity = '1';
    await delay(300);
    image3.style.opacity = '0';
    image2.style.opacity = '1';
});
  
// 2-3-2-3-2-1
imageContainer.addEventListener('mouseout', async () => {
    image2.style.opacity = '0';
    image3.style.opacity = '1';
    await delay(300);
    image3.style.opacity = '0';
    image2.style.opacity = '1';
    await delay(300);
    image2.style.opacity = '0';
    image3.style.opacity = '1';
    await delay(300);
    image3.style.opacity = '0';
    image2.style.opacity = '1';
    await delay(300);
    image2.style.opacity = '0';
    image1.style.opacity = '1';
});
  
  function delay(ms){
    return new Promise(resolve => setTimeout(resolve, ms));
  }
  
