 <!-- Top Navbar -->
 <div class="navbar">
     <div class="nav-logo">
         <span>📦</span> StoreManager Pro
     </div>
     <div class="nav-menu">
         <button class="nav-item" id="nav-dashboard" onclick="switchView('dashboard')">Tableau de Bord</button>
         <button class="nav-item" id="nav-pos" onclick="switchView('pos')">Ventes / POS</button>
         <button class="nav-item" id="nav-dettes" onclick="switchView('dettes')">Gestion Dettes</button>
         <button class="nav-item" id="nav-supplies" onclick="switchView('supplies')">Approvisionnements</button>
         <button class="nav-item" id="nav-catalog" onclick="switchView('catalog')">Produits & Tiers</button>
     </div>

     <div style="margin-left: auto; display: flex; align-items: center; gap: 14px;">
         <div style="text-align: right;">
             <div id="current-user-role" style="font-size: 12px; font-weight: 800; color: var(--accent);">Admin Boutique</div>
             <div style="font-size: 10px; color: var(--text-muted);">Session active</div>
         </div>
         <button type="button" class="btn-quick-action" onclick="logout()" style="border-color: var(--danger); color: var(--danger); background: rgba(248, 113, 113, 0.08); padding: 8px 12px;">Déconnexion 🚪</button>
     </div>
 </div>