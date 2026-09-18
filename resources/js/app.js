const cart = new Map();
const money = new Intl.NumberFormat('fa-IR');
function updateCart(){
  const count=[...cart.values()].reduce((sum,item)=>sum+item.qty,0);
  const total=[...cart.values()].reduce((sum,item)=>sum+item.qty*item.price,0);
  document.querySelectorAll('[data-cart-count]').forEach(el=>el.textContent=money.format(count));
  document.querySelectorAll('[data-cart-total]').forEach(el=>el.textContent=total?money.format(total)+' تومان':'۰ تومان');
  const btn=document.querySelector('[data-cart-button]');
  if(btn)btn.setAttribute('aria-label',count?`سبد خرید، ${money.format(count)} قلم`:'سبد خرید خالی');
}
function toast(message){
  const el=document.querySelector('[data-toast]'); if(!el)return;
  el.textContent=message;el.classList.add('show');clearTimeout(window.__toastTimer);
  window.__toastTimer=setTimeout(()=>el.classList.remove('show'),2400);
}
function syncResults(){
  const input=document.querySelector('[data-search-input]');
  const term=input?.value.trim().toLocaleLowerCase('fa-IR')||'';
  let visible=0;
  document.querySelectorAll('[data-product]').forEach(card=>{
    const match=!term||card.textContent.toLocaleLowerCase('fa-IR').includes(term);
    card.hidden=!match;if(match)visible++;
  });
  const empty=document.querySelector('[data-empty]');
  if(empty)empty.style.display=visible?'none':'block';
}
document.addEventListener('click',event=>{
  const add=event.target.closest('[data-add]');
  if(add){
    const id=add.dataset.add,product={id,title:add.dataset.title,price:Number(add.dataset.price||0)};
    const current=cart.get(id)||{...product,qty:0};current.qty+=1;cart.set(id,current);updateCart();
    toast(`${product.title} به سبد خرید اضافه شد`);
  }
  const searchBtn=event.target.closest('[data-search]');
  if(searchBtn){document.querySelector('[data-search-input]')?.focus();document.querySelector('#products')?.scrollIntoView({behavior:'smooth',block:'start'});}
  const cartBtn=event.target.closest('[data-cart-button]');
  if(cartBtn){const count=[...cart.values()].reduce((sum,item)=>sum+item.qty,0);toast(count?`سبد خرید شما ${money.format(count)} قلم دارد`:'سبد خرید هنوز خالی است');}
});
document.querySelector('[data-search-input]')?.addEventListener('input',syncResults);
updateCart();