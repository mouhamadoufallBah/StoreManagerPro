 <div>
     <div class="kpi-grid">
         <!-- Radial Chart 1 -->
         <div class="kpi-card" style="border-left: 4px solid var(--success);">
             <div>
                 <div class="kpi-label">Ventes Comptant</div>
                 <div class="kpi-val" style="color: var(--success);">92 000 F</div>
             </div>
             <div class="progress-ring-container">
                 <svg class="progress-ring" width="60" height="60">
                     <circle class="progress-ring-circle-bg" cx="30" cy="30" r="25" />
                     <circle class="progress-ring-circle" style="stroke: var(--success); stroke-dashoffset: 20;" cx="30" cy="30" r="25" />
                 </svg>
             </div>
         </div>
         <!-- Radial Chart 2 -->
         <div class="kpi-card" style="border-left: 4px solid var(--danger);">
             <div>
                 <div class="kpi-label">Dettes à Récupérer</div>
                 <div class="kpi-val" style="color: var(--danger);">99 000 F</div>
             </div>
             <div class="progress-ring-container">
                 <svg class="progress-ring" width="60" height="60">
                     <circle class="progress-ring-circle-bg" cx="30" cy="30" r="25" />
                     <circle class="progress-ring-circle" style="stroke: var(--danger); stroke-dashoffset: 70;" cx="30" cy="30" r="25" />
                 </svg>
             </div>
         </div>
         <!-- Radial Chart 3 -->
         <div class="kpi-card" style="border-left: 4px solid var(--accent);">
             <div>
                 <div class="kpi-label">Volume Approvisionné</div>
                 <div class="kpi-val" style="color: var(--accent);">4 520 000 F</div>
             </div>
             <div class="progress-ring-container">
                 <svg class="progress-ring" width="60" height="60">
                     <circle class="progress-ring-circle-bg" cx="30" cy="30" r="25" />
                     <circle class="progress-ring-circle" style="stroke: var(--accent); stroke-dashoffset: 40;" cx="30" cy="30" r="25" />
                 </svg>
             </div>
         </div>
         <!-- Radial Chart 4 -->
         <div class="kpi-card" style="border-left: 4px solid var(--warning);">
             <div>
                 <div class="kpi-label">Valeur du Stock</div>
                 <div class="kpi-val" style="color: var(--warning);">3 476 000 F</div>
             </div>
             <div class="progress-ring-container">
                 <svg class="progress-ring" width="60" height="60">
                     <circle class="progress-ring-circle-bg" cx="30" cy="30" r="25" />
                     <circle class="progress-ring-circle" style="stroke: var(--warning); stroke-dashoffset: 15;" cx="30" cy="30" r="25" />
                 </svg>
             </div>
         </div>
         <!-- Radial Chart 5 -->
         <div class="kpi-card" style="border-left: 4px solid var(--success);">
             <div>
                 <div class="kpi-label">Taux de Recouvrement</div>
                 <div class="kpi-val" style="color: var(--success);">25.6 %</div>
             </div>
             <div class="progress-ring-container">
                 <svg class="progress-ring" width="60" height="60">
                     <circle class="progress-ring-circle-bg" cx="30" cy="30" r="25" />
                     <circle class="progress-ring-circle" style="stroke: var(--success); stroke-dashoffset: 116.808;" cx="30" cy="30" r="25" />
                 </svg>
             </div>
         </div>
         <!-- Radial Chart 6 -->
         <div class="kpi-card" style="border-left: 4px solid var(--accent);">
             <div>
                 <div class="kpi-label">Panier Moyen</div>
                 <div class="kpi-val" style="color: var(--accent);">47 750 F</div>
             </div>
             <div class="progress-ring-container">
                 <svg class="progress-ring" width="60" height="60">
                     <circle class="progress-ring-circle-bg" cx="30" cy="30" r="25" />
                     <circle class="progress-ring-circle" style="stroke: var(--accent); stroke-dashoffset: 50;" cx="30" cy="30" r="25" />
                 </svg>
             </div>
         </div>
     </div>

     <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 32px; align-items: start;">
         <!-- Left column card with tabs -->
         <div class="panel-card" style="padding: 20px;">
             <div style="display: flex; gap: 8px; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                 <button id="dash-left-tab-sales" class="nav-item active" style="flex: 1; padding: 10px; font-size: 11px; text-transform: uppercase;" onclick="switchDashLeftTab('sales')">🛒 Ventes Récentes</button>
                 <button id="dash-left-tab-debts" class="nav-item" style="flex: 1; padding: 10px; font-size: 11px; text-transform: uppercase;" onclick="switchDashLeftTab('debts')">🔴 Dettes du Jour</button>
                 <button id="dash-left-tab-ruptures" class="nav-item" style="flex: 1; padding: 10px; font-size: 11px; text-transform: uppercase;" onclick="switchDashLeftTab('ruptures')">⚠️ Ruptures & Alertes</button>
             </div>

             <!-- Tab 1: Ventes Récentes -->
             <div id="dash-left-panel-sales">
                 <div class="panel-title">Flux de Ventes Récentes</div>
                 <table class="debt-table">
                     <thead>
                         <tr>
                             <th>Facture</th>
                             <th>Date</th>
                             <th>Client</th>
                             <th>Total</th>
                             <th>Paiement</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td style="font-weight: 700; color: var(--text-muted);">#CMD-4</td>
                             <td>07 Aug 23:48</td>
                             <td style="font-weight: 700;">Maimouna Diallo</td>
                             <td style="font-weight: 800; color: var(--accent);">15 000 F</td>
                             <td>
                                 <span class="badge non-payee">
                                     CRÉDIT </span>
                             </td>
                         </tr>
                         <tr>
                             <td style="font-weight: 700; color: var(--text-muted);">#CMD-3</td>
                             <td>07 Aug 22:48</td>
                             <td style="font-weight: 700;">Moussa Sarr</td>
                             <td style="font-weight: 800; color: var(--accent);">74 000 F</td>
                             <td>
                                 <span class="badge non-payee">
                                     CRÉDIT </span>
                             </td>
                         </tr>
                         <tr>
                             <td style="font-weight: 700; color: var(--text-muted);">#CMD-2</td>
                             <td>07 Aug 21:48</td>
                             <td style="font-weight: 700;">Fama Diouf</td>
                             <td style="font-weight: 800; color: var(--accent);">44 000 F</td>
                             <td>
                                 <span class="badge non-payee">
                                     CRÉDIT </span>
                             </td>
                         </tr>
                         <tr>
                             <td style="font-weight: 700; color: var(--text-muted);">#CMD-1</td>
                             <td>01 Aug 10:30</td>
                             <td style="font-weight: 700;">Abdou Ndiaye</td>
                             <td style="font-weight: 800; color: var(--accent);">58 000 F</td>
                             <td>
                                 <span class="badge payee">
                                     Wave </span>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <!-- Tab 2: Dettes du Jour -->
             <div id="dash-left-panel-debts" style="display: none;">
                 <div class="panel-title" style="border-left-color: var(--danger);">Dettes à recouvrer aujourd'hui</div>
                 <table class="debt-table" style="font-size: 12px;">
                     <thead>
                         <tr>
                             <th>Client</th>
                             <th>Date Création</th>
                             <th>Montant Initial</th>
                             <th>Reste Dû</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 16px 0;">Aucun crédit en cours créé aujourd'hui.</td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <!-- Tab 3: Ruptures & Stocks Critiques -->
             <div id="dash-left-panel-ruptures" style="display: none;">
                 <div class="panel-title" style="border-left-color: var(--danger);">Ruptures & Stocks Critiques</div>
                 <div style="display: flex; flex-direction: column; gap: 14px;">
                     <div style="background: rgba(251,191,36,0.05); padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.02);">
                         <div style="display: flex; justify-content: space-between; align-items: center;">
                             <div>
                                 <div style="font-weight: 700; font-size: 13px;">Bidon d&#039;huile 5L</div>
                                 <div style="color: var(--warning); font-weight: 800; font-size: 11px;">5 en stock</div>
                             </div>
                             <button type="button" class="btn-quick-action" onclick="toggleDetails('supply-product-drawer-2')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Approvisionner</button>
                         </div>

                         <!-- Inline drawer for quick supply request -->
                         <div class="details-drawer" id="supply-product-drawer-2" style="margin-top: 10px; padding: 10px;">
                             <div style="font-weight: 700; font-size: 11px; color: var(--accent); margin-bottom: 6px;">Commande d'Approvisionnement Rapide :</div>
                             <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="" style="display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 8px; align-items: flex-end;">
                                 <input type="hidden" name="action" value="quick_supply_product">
                                 <input type="hidden" name="produit_id" value="2">

                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Fournisseur</label>
                                     <select name="fournisseur_id" class="form-control" style="font-size: 11px; padding: 6px;" required>
                                         <option value="1">Comptoir Céréalier Sénégalais</option>
                                         <option value="2">Grossiste Diop &amp; Frères</option>
                                         <option value="3">Sénégal Import-Export</option>
                                     </select>
                                 </div>
                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Qté à Commander</label>
                                     <input type="number" name="quantite" class="form-control" value="50" min="1" required style="font-size: 11px; padding: 6px;">
                                 </div>
                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Coût Achat (F)</label>
                                     <input type="number" name="cout_achat_unitaire" class="form-control" value="5600" min="0" required style="font-size: 11px; padding: 6px;">
                                 </div>
                                 <button type="submit" class="btn-submit btn-success" style="padding: 6px 12px; font-size: 10px; text-transform: uppercase;">Valider BL</button>
                             </form>
                         </div>
                     </div>
                     <div style="background: rgba(251,191,36,0.05); padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.02);">
                         <div style="display: flex; justify-content: space-between; align-items: center;">
                             <div>
                                 <div style="font-weight: 700; font-size: 13px;">Carton de savon</div>
                                 <div style="color: var(--warning); font-weight: 800; font-size: 11px;">3 en stock</div>
                             </div>
                             <button type="button" class="btn-quick-action" onclick="toggleDetails('supply-product-drawer-3')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Approvisionner</button>
                         </div>

                         <!-- Inline drawer for quick supply request -->
                         <div class="details-drawer" id="supply-product-drawer-3" style="margin-top: 10px; padding: 10px;">
                             <div style="font-weight: 700; font-size: 11px; color: var(--accent); margin-bottom: 6px;">Commande d'Approvisionnement Rapide :</div>
                             <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="" style="display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 8px; align-items: flex-end;">
                                 <input type="hidden" name="action" value="quick_supply_product">
                                 <input type="hidden" name="produit_id" value="3">

                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Fournisseur</label>
                                     <select name="fournisseur_id" class="form-control" style="font-size: 11px; padding: 6px;" required>
                                         <option value="1">Comptoir Céréalier Sénégalais</option>
                                         <option value="2">Grossiste Diop &amp; Frères</option>
                                         <option value="3">Sénégal Import-Export</option>
                                     </select>
                                 </div>
                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Qté à Commander</label>
                                     <input type="number" name="quantite" class="form-control" value="50" min="1" required style="font-size: 11px; padding: 6px;">
                                 </div>
                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Coût Achat (F)</label>
                                     <input type="number" name="cout_achat_unitaire" class="form-control" value="8400" min="0" required style="font-size: 11px; padding: 6px;">
                                 </div>
                                 <button type="submit" class="btn-submit btn-success" style="padding: 6px 12px; font-size: 10px; text-transform: uppercase;">Valider BL</button>
                             </form>
                         </div>
                     </div>
                     <div style="background: rgba(248,113,113,0.05); padding: 12px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.02);">
                         <div style="display: flex; justify-content: space-between; align-items: center;">
                             <div>
                                 <div style="font-weight: 700; font-size: 13px;">Huile de palme 1L</div>
                                 <div style="color: var(--danger); font-weight: 800; font-size: 11px;">0 en stock</div>
                             </div>
                             <button type="button" class="btn-quick-action" onclick="toggleDetails('supply-product-drawer-6')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Approvisionner</button>
                         </div>

                         <!-- Inline drawer for quick supply request -->
                         <div class="details-drawer" id="supply-product-drawer-6" style="margin-top: 10px; padding: 10px;">
                             <div style="font-weight: 700; font-size: 11px; color: var(--accent); margin-bottom: 6px;">Commande d'Approvisionnement Rapide :</div>
                             <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="" style="display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 8px; align-items: flex-end;">
                                 <input type="hidden" name="action" value="quick_supply_product">
                                 <input type="hidden" name="produit_id" value="6">

                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Fournisseur</label>
                                     <select name="fournisseur_id" class="form-control" style="font-size: 11px; padding: 6px;" required>
                                         <option value="1">Comptoir Céréalier Sénégalais</option>
                                         <option value="2">Grossiste Diop &amp; Frères</option>
                                         <option value="3">Sénégal Import-Export</option>
                                     </select>
                                 </div>
                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Qté à Commander</label>
                                     <input type="number" name="quantite" class="form-control" value="50" min="1" required style="font-size: 11px; padding: 6px;">
                                 </div>
                                 <div>
                                     <label style="font-size: 9px; color: var(--text-muted); display: block; margin-bottom: 2px;">Coût Achat (F)</label>
                                     <input type="number" name="cout_achat_unitaire" class="form-control" value="1400" min="0" required style="font-size: 11px; padding: 6px;">
                                 </div>
                                 <button type="submit" class="btn-submit btn-success" style="padding: 6px 12px; font-size: 10px; text-transform: uppercase;">Valider BL</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Right column card with tabs -->
         <div class="panel-card" style="padding: 20px;">
             <div style="display: flex; gap: 8px; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                 <button id="dash-right-tab-supplies" class="nav-item active" style="flex: 1; padding: 10px; font-size: 11px; text-transform: uppercase;" onclick="switchDashRightTab('supplies')">📦 Livraisons du Jour</button>
                 <button id="dash-right-tab-debtors" class="nav-item" style="flex: 1; padding: 10px; font-size: 11px; text-transform: uppercase;" onclick="switchDashRightTab('debtors')">👥 Clients Débiteurs</button>
                 <button id="dash-right-tab-fournisseurs" class="nav-item" style="flex: 1; padding: 10px; font-size: 11px; text-transform: uppercase;" onclick="switchDashRightTab('fournisseurs')">🤝 Solde Fournisseurs</button>
             </div>

             <!-- Tab 1: Approvisionnements attendus aujourd'hui -->
             <div id="dash-right-panel-supplies">
                 <div class="panel-title" style="border-left-color: var(--warning);">Approvisionnements attendus aujourd'hui</div>
                 <table class="debt-table" style="font-size: 12px;">
                     <thead>
                         <tr>
                             <th>Réf BL</th>
                             <th>Fournisseur</th>
                             <th>Valeur Lot</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 16px 0;">Aucune livraison attendue aujourd'hui.</td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <!-- Tab 2: Clients Débiteurs -->
             <div id="dash-right-panel-debtors" style="display: none;">
                 <div class="panel-title" style="border-left-color: var(--danger);">Clients avec Dettes en cours</div>
                 <table class="debt-table" style="font-size: 12px;">
                     <thead>
                         <tr>
                             <th>Client</th>
                             <th>Dettes</th>
                             <th>Cumul Dû</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td style="font-weight: 700;">
                                 Moussa Sarr <div style="font-size: 10px; color: var(--text-muted); font-weight: normal;">769876543</div>
                             </td>
                             <td style="text-align: center; font-weight: 700;">1</td>
                             <td style="font-weight: 800; color: var(--danger);">50 000 F</td>
                             <td>
                                 <button type="button" class="btn-quick-action" onclick="toggleDetails('client-debts-drawer-3')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Dettes</button>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="4" style="padding: 0; border: none;">
                                 <div class="details-drawer" id="client-debts-drawer-3">
                                     <div style="font-weight: 700; font-size: 11px; color: var(--accent); margin-bottom: 6px;">Dettes en cours de Moussa Sarr :</div>
                                     <table class="debt-table" style="font-size: 10px;">
                                         <thead>
                                             <tr>
                                                 <th>Réf Dette</th>
                                                 <th>Date</th>
                                                 <th>Initial</th>
                                                 <th>Payé</th>
                                                 <th>Reste Dû</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td style="font-weight: 700; color: var(--text-muted);">#DT-2</td>
                                                 <td>07 Aug 22:48</td>
                                                 <td style="font-weight: 700;">74 000 F</td>
                                                 <td style="color: var(--success);">24 000 F</td>
                                                 <td style="color: var(--danger); font-weight: 800;">50 000 F</td>
                                                 <td>
                                                     <button type="button" class="btn-quick-action" onclick="switchView('dettes'); toggleDetails('debt-repay-drawer-2')" style="border-color: var(--danger); color: var(--danger);">Rembourser</button>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="font-weight: 700;">
                                 Fama Diouf <div style="font-size: 10px; color: var(--text-muted); font-weight: normal;">781234567</div>
                             </td>
                             <td style="text-align: center; font-weight: 700;">1</td>
                             <td style="font-weight: 800; color: var(--danger);">34 000 F</td>
                             <td>
                                 <button type="button" class="btn-quick-action" onclick="toggleDetails('client-debts-drawer-2')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Dettes</button>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="4" style="padding: 0; border: none;">
                                 <div class="details-drawer" id="client-debts-drawer-2">
                                     <div style="font-weight: 700; font-size: 11px; color: var(--accent); margin-bottom: 6px;">Dettes en cours de Fama Diouf :</div>
                                     <table class="debt-table" style="font-size: 10px;">
                                         <thead>
                                             <tr>
                                                 <th>Réf Dette</th>
                                                 <th>Date</th>
                                                 <th>Initial</th>
                                                 <th>Payé</th>
                                                 <th>Reste Dû</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td style="font-weight: 700; color: var(--text-muted);">#DT-1</td>
                                                 <td>07 Aug 21:48</td>
                                                 <td style="font-weight: 700;">44 000 F</td>
                                                 <td style="color: var(--success);">10 000 F</td>
                                                 <td style="color: var(--danger); font-weight: 800;">34 000 F</td>
                                                 <td>
                                                     <button type="button" class="btn-quick-action" onclick="switchView('dettes'); toggleDetails('debt-repay-drawer-1')" style="border-color: var(--danger); color: var(--danger);">Rembourser</button>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="font-weight: 700;">
                                 Maimouna Diallo <div style="font-size: 10px; color: var(--text-muted); font-weight: normal;">701122334</div>
                             </td>
                             <td style="text-align: center; font-weight: 700;">1</td>
                             <td style="font-weight: 800; color: var(--danger);">15 000 F</td>
                             <td>
                                 <button type="button" class="btn-quick-action" onclick="toggleDetails('client-debts-drawer-4')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Dettes</button>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="4" style="padding: 0; border: none;">
                                 <div class="details-drawer" id="client-debts-drawer-4">
                                     <div style="font-weight: 700; font-size: 11px; color: var(--accent); margin-bottom: 6px;">Dettes en cours de Maimouna Diallo :</div>
                                     <table class="debt-table" style="font-size: 10px;">
                                         <thead>
                                             <tr>
                                                 <th>Réf Dette</th>
                                                 <th>Date</th>
                                                 <th>Initial</th>
                                                 <th>Payé</th>
                                                 <th>Reste Dû</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td style="font-weight: 700; color: var(--text-muted);">#DT-3</td>
                                                 <td>07 Aug 23:48</td>
                                                 <td style="font-weight: 700;">15 000 F</td>
                                                 <td style="color: var(--success);">0 F</td>
                                                 <td style="color: var(--danger); font-weight: 800;">15 000 F</td>
                                                 <td>
                                                     <button type="button" class="btn-quick-action" onclick="switchView('dettes'); toggleDetails('debt-repay-drawer-3')" style="border-color: var(--danger); color: var(--danger);">Rembourser</button>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <!-- Tab 3: Fournisseurs & Cumul Dû -->
             <div id="dash-right-panel-fournisseurs" style="display: none;">
                 <div class="panel-title" style="border-left-color: var(--accent);">Facturation / Cumul par Fournisseur</div>
                 <table class="debt-table" style="font-size: 12px;">
                     <thead>
                         <tr>
                             <th>Fournisseur</th>
                             <th>Reste à Payer</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td style="font-weight: 700;">
                                 Comptoir Céréalier Sénégalais <div style="font-size: 10px; color: var(--text-muted); font-weight: normal;">Tél : 338245678</div>
                             </td>
                             <td style="font-weight: 800; color: var(--accent);">525 000 F</td>
                             <td style="display: flex; gap: 6px; align-items: center;">
                                 <button type="button" class="btn-quick-action" onclick="toggleDetails('supplier-invoices-drawer-1')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Détail</button>

                                 <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="" style="display: inline; margin: 0;">
                                     <input type="hidden" name="action" value="pay_supplier">
                                     <input type="hidden" name="fournisseur_id" value="1">
                                     <button type="submit" class="btn-quick-action" style="border-color: var(--success); color: var(--success); background: rgba(52, 211, 153, 0.05);">Tout Payer</button>
                                 </form>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="3" style="padding: 0; border: none;">
                                 <div class="details-drawer" id="supplier-invoices-drawer-1" style="border: 1px solid rgba(45, 212, 191, 0.25); background: linear-gradient(180deg, rgba(11, 15, 25, 0.95) 0%, rgba(11, 15, 25, 0.98) 100%); border-radius: 12px; padding: 14px 16px; margin: 8px 0;">
                                     <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border-bottom: 1px dashed var(--border-color); padding-bottom: 8px;">
                                         <div style="font-weight: 800; font-size: 11px; color: var(--accent);">
                                             Factures en attente de règlement — Comptoir Céréalier Sénégalais :
                                         </div>
                                         <div style="font-size: 10px; font-weight: 800; color: var(--danger);">
                                             Total Dû : 525 000 FCFA
                                         </div>
                                     </div>
                                     <table class="debt-table" style="font-size: 11px;">
                                         <thead>
                                             <tr>
                                                 <th>Réf BL</th>
                                                 <th>Date Réception</th>
                                                 <th>Montant Facture</th>
                                                 <th>Statut Règlement</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 10px 0;">Aucune facture impayée pour ce fournisseur.</td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="font-weight: 700;">
                                 Grossiste Diop &amp; Frères <div style="font-size: 10px; color: var(--text-muted); font-weight: normal;">Tél : 773456789</div>
                             </td>
                             <td style="font-weight: 800; color: var(--accent);">320 000 F</td>
                             <td style="display: flex; gap: 6px; align-items: center;">
                                 <button type="button" class="btn-quick-action" onclick="toggleDetails('supplier-invoices-drawer-2')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Détail</button>

                                 <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="" style="display: inline; margin: 0;">
                                     <input type="hidden" name="action" value="pay_supplier">
                                     <input type="hidden" name="fournisseur_id" value="2">
                                     <button type="submit" class="btn-quick-action" style="border-color: var(--success); color: var(--success); background: rgba(52, 211, 153, 0.05);">Tout Payer</button>
                                 </form>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="3" style="padding: 0; border: none;">
                                 <div class="details-drawer" id="supplier-invoices-drawer-2" style="border: 1px solid rgba(45, 212, 191, 0.25); background: linear-gradient(180deg, rgba(11, 15, 25, 0.95) 0%, rgba(11, 15, 25, 0.98) 100%); border-radius: 12px; padding: 14px 16px; margin: 8px 0;">
                                     <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border-bottom: 1px dashed var(--border-color); padding-bottom: 8px;">
                                         <div style="font-weight: 800; font-size: 11px; color: var(--accent);">
                                             Factures en attente de règlement — Grossiste Diop &amp; Frères :
                                         </div>
                                         <div style="font-size: 10px; font-weight: 800; color: var(--danger);">
                                             Total Dû : 320 000 FCFA
                                         </div>
                                     </div>
                                     <table class="debt-table" style="font-size: 11px;">
                                         <thead>
                                             <tr>
                                                 <th>Réf BL</th>
                                                 <th>Date Réception</th>
                                                 <th>Montant Facture</th>
                                                 <th>Statut Règlement</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td style="font-weight: 700; color: var(--text-muted);">#BL-DIP-099</td>
                                                 <td>03 Aug 2026</td>
                                                 <td style="font-weight: 800; color: var(--accent);">320 000 F</td>
                                                 <td>
                                                     <span class="badge badge-danger">NON PAYÉ</span>
                                                 </td>
                                                 <td>
                                                     <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="" style="display: inline; margin: 0;">
                                                         <input type="hidden" name="action" value="pay_supplier_invoice">
                                                         <input type="hidden" name="approvisionnement_id" value="2">
                                                         <button type="submit" class="btn-quick-action" style="border-color: var(--success); color: var(--success); background: rgba(52, 211, 153, 0.08); font-weight: 700;">✓ Payer</button>
                                                     </form>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="font-weight: 700;">
                                 Sénégal Import-Export <div style="font-size: 10px; color: var(--text-muted); font-weight: normal;">Tél : 338211010</div>
                             </td>
                             <td style="font-weight: 800; color: var(--accent);">190 000 F</td>
                             <td style="display: flex; gap: 6px; align-items: center;">
                                 <button type="button" class="btn-quick-action" onclick="toggleDetails('supplier-invoices-drawer-3')" style="border-color: var(--accent); color: var(--accent); background: rgba(45, 212, 191, 0.05);">Détail</button>

                                 <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="" style="display: inline; margin: 0;">
                                     <input type="hidden" name="action" value="pay_supplier">
                                     <input type="hidden" name="fournisseur_id" value="3">
                                     <button type="submit" class="btn-quick-action" style="border-color: var(--success); color: var(--success); background: rgba(52, 211, 153, 0.05);">Tout Payer</button>
                                 </form>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="3" style="padding: 0; border: none;">
                                 <div class="details-drawer" id="supplier-invoices-drawer-3" style="border: 1px solid rgba(45, 212, 191, 0.25); background: linear-gradient(180deg, rgba(11, 15, 25, 0.95) 0%, rgba(11, 15, 25, 0.98) 100%); border-radius: 12px; padding: 14px 16px; margin: 8px 0;">
                                     <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border-bottom: 1px dashed var(--border-color); padding-bottom: 8px;">
                                         <div style="font-weight: 800; font-size: 11px; color: var(--accent);">
                                             Factures en attente de règlement — Sénégal Import-Export :
                                         </div>
                                         <div style="font-size: 10px; font-weight: 800; color: var(--danger);">
                                             Total Dû : 190 000 FCFA
                                         </div>
                                     </div>
                                     <table class="debt-table" style="font-size: 11px;">
                                         <thead>
                                             <tr>
                                                 <th>Réf BL</th>
                                                 <th>Date Réception</th>
                                                 <th>Montant Facture</th>
                                                 <th>Statut Règlement</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             <tr>
                                                 <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 10px 0;">Aucune facture impayée pour ce fournisseur.</td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>