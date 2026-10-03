const searchInput=document.getElementById("searchInput");
const categoryFilter=document.getElementById("categoryFilter");
const cards=[...document.querySelectorAll(".book-card")];
const noResults=document.getElementById("noResults");

if(categoryFilter){
  [...new Set(cards.map(c=>c.dataset.category))].sort().forEach(cat=>{
    const option=document.createElement("option");
    option.value=cat; option.textContent=cat; categoryFilter.appendChild(option);
  });
}
function filterBooks(){
  const q=(searchInput?.value||"").toLowerCase().trim();
  const cat=categoryFilter?.value||"";
  let count=0;
  cards.forEach(card=>{
    const matchText=card.dataset.title.includes(q);
    const matchCat=!cat||card.dataset.category===cat;
    card.style.display=(matchText&&matchCat)?"":"none";
    if(matchText&&matchCat) count++;
  });
  if(noResults) noResults.classList.toggle("hidden",count!==0);
}
searchInput?.addEventListener("input",filterBooks);
categoryFilter?.addEventListener("change",filterBooks);
setTimeout(()=>{
  document.querySelectorAll(".alert").forEach(el=>{el.style.opacity="0";el.style.transition="opacity .5s";setTimeout(()=>el.remove(),500);});
},5000);
