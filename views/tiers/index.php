<div>
            <!-- Catalog Stats Grid -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
                <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--success);">
                    <div>
                        <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Valeur Totale Stock</span>
                        <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;">3 476 000 F</div>
                    </div>
                    <span style="font-size: 24px;">📦</span>
                </div>
                <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--accent);">
                    <div>
                        <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Articles au Catalogue</span>
                        <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;">6 références</div>
                    </div>
                    <span style="font-size: 24px;">🏷️</span>
                </div>
                <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--warning);">
                    <div>
                        <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Clients Enregistrés</span>
                        <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;">10 clients</div>
                    </div>
                    <span style="font-size: 24px;">👥</span>
                </div>
            </div>

            <!-- Tab Navigation for Catalog -->
            <div style="display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                <button id="catalog-tab-btn-products" class="nav-item active" style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; font-weight: 700;" onclick="switchCatalogTab('products')">🏷️ Gestion Produits</button>
                <button id="catalog-tab-btn-clients" class="nav-item" style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; font-weight: 700;" onclick="switchCatalogTab('clients')">👥 Gestion Clients</button>
                <button id="catalog-tab-btn-suppliers" class="nav-item" style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; font-weight: 700;" onclick="switchCatalogTab('suppliers')">🤝 Gestion Fournisseurs</button>
            </div>

            <!-- TAB 1: Gestion Produits -->
            <div id="catalog-panel-products" style="display: grid; grid-template-columns: 600px 1fr; gap: 32px; align-items: start;">
                <!-- Left: Form -->
                <div class="panel-card" style="margin-bottom: 0;">
                    <div class="panel-title">Ajouter un Article</div>
                    <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="">
                        <input type="hidden" name="action" value="add_product">
                        <div class="form-group">
                            <label for="nom">Nom de l'Article</label>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: Carton de savon" required>
                        </div>
                        <div class="form-group">
                            <label for="prix_unitaire">Prix de Vente (FCFA)</label>
                            <input type="number" name="prix_unitaire" class="form-control" placeholder="Ex: 12000" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="quantite_stock">Stock Initial</label>
                            <input type="number" name="quantite_stock" class="form-control" placeholder="Ex: 50" min="0" required>
                        </div>
                        <button type="submit" class="btn-submit btn-success" style="width: 100%;">Enregistrer le Produit (DML)</button>
                    </form>
                </div>

                <!-- Right: Product list -->
                <div class="panel-card" style="margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <label style="font-size: 13px; font-weight: 700; color: var(--accent); text-transform: uppercase;">Catalogue Courant</label>
                        <input type="text" id="catalog-search" class="search-control" placeholder="Filtrer les produits..." onkeyup="filterProductsTable()">
                    </div>
                    <table class="debt-table" id="catalog-main-table">
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>Prix de Vente</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                                                            <tr data-product-name="bidon d&#039;huile 5l">
                                    <td style="font-weight: 700;">Bidon d&#039;huile 5L</td>
                                    <td>8 000 F</td>
                                    <td style="font-weight: 700; color: var(--danger);">
                                        5                                    </td>
                                </tr>
                                                            <tr data-product-name="carton de lait">
                                    <td style="font-weight: 700;">Carton de lait</td>
                                    <td>15 000 F</td>
                                    <td style="font-weight: 700; color: var(--success);">
                                        40                                    </td>
                                </tr>
                                                            <tr data-product-name="carton de savon">
                                    <td style="font-weight: 700;">Carton de savon</td>
                                    <td>12 000 F</td>
                                    <td style="font-weight: 700; color: var(--danger);">
                                        3                                    </td>
                                </tr>
                                                            <tr data-product-name="huile de palme 1l">
                                    <td style="font-weight: 700;">Huile de palme 1L</td>
                                    <td>2 000 F</td>
                                    <td style="font-weight: 700; color: var(--danger);">
                                        0                                    </td>
                                </tr>
                                                            <tr data-product-name="paquet de sucre 1kg">
                                    <td style="font-weight: 700;">Paquet de sucre 1kg</td>
                                    <td>1 500 F</td>
                                    <td style="font-weight: 700; color: var(--success);">
                                        200                                    </td>
                                </tr>
                                                            <tr data-product-name="sac de riz 50kg">
                                    <td style="font-weight: 700;">Sac de riz 50kg</td>
                                    <td>25 000 F</td>
                                    <td style="font-weight: 700; color: var(--success);">
                                        100                                    </td>
                                </tr>
                                                    </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 2: Gestion Clients -->
            <div id="catalog-panel-clients" style="display: none; grid-template-columns: 600px 1fr; gap: 32px; align-items: start;">
                <!-- Left: Form -->
                <div class="panel-card" style="margin-bottom: 0;">
                    <div class="panel-title">Enregistrer un Client</div>
                    <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="">
                        <input type="hidden" name="action" value="add_client">
                        <div class="form-row" style="display: flex; gap: 12px;">
                            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                                <label for="prenom">Prénom</label>
                                <input type="text" name="prenom" class="form-control" placeholder="Ex: Abdou" required>
                            </div>
                            <div class="form-group" style="flex: 1; margin-bottom: 0;">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" class="form-control" placeholder="Ex: Ndiaye" required>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 12px;">
                            <label for="telephone">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" placeholder="Ex: 776543210" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="Ex: client@email.sn">
                        </div>
                        <div class="form-group">
                            <label for="limite_credit">Limite de Crédit (FCFA)</label>
                            <input type="number" name="limite_credit" class="form-control" value="150000" min="0" required>
                        </div>
                        <button type="submit" class="btn-submit" style="width: 100%;">Créer le Compte Client (DML)</button>
                    </form>
                </div>

                <!-- Right: Clients list -->
                <div class="panel-card" style="margin-bottom: 0;">
                    <label style="font-size: 13px; font-weight: 700; color: var(--accent); display: block; margin-bottom: 12px; text-transform: uppercase;">Répertoire Clients</label>
                    <table class="debt-table" id="clients-main-table" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Téléphone</th>
                                <th>Limite de Crédit</th>
                            </tr>
                        </thead>
                        <tbody>
                                                            <tr>
                                    <td style="font-weight: 700;">Awa Cisse</td>
                                    <td>783332211</td>
                                    <td style="font-weight: 700; color: var(--accent);">300 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Maimouna Diallo</td>
                                    <td>701122334</td>
                                    <td style="font-weight: 700; color: var(--accent);">120 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Fama Diouf</td>
                                    <td>781234567</td>
                                    <td style="font-weight: 700; color: var(--accent);">200 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Fatou Fall</td>
                                    <td>789998877</td>
                                    <td style="font-weight: 700; color: var(--accent);">250 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Babacar Faye</td>
                                    <td>762221100</td>
                                    <td style="font-weight: 700; color: var(--accent);">150 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Ibrahima Gueye</td>
                                    <td>778887766</td>
                                    <td style="font-weight: 700; color: var(--accent);">100 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Khady Mbacke</td>
                                    <td>704443322</td>
                                    <td style="font-weight: 700; color: var(--accent);">400 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Abdou Ndiaye</td>
                                    <td>776543210</td>
                                    <td style="font-weight: 700; color: var(--accent);">150 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Moussa Sarr</td>
                                    <td>769876543</td>
                                    <td style="font-weight: 700; color: var(--accent);">250 000 F</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Ousmane Sow</td>
                                    <td>775554433</td>
                                    <td style="font-weight: 700; color: var(--accent);">180 000 F</td>
                                </tr>
                                                    </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 3: Gestion Fournisseurs -->
            <div id="catalog-panel-suppliers" style="display: none; grid-template-columns: 600px 1fr; gap: 32px; align-items: start;">
                <!-- Left: Form -->
                <div class="panel-card" style="margin-bottom: 0;">
                    <div class="panel-title">Enregistrer un Fournisseur</div>
                    <form method="GET" action="#" onsubmit="event.preventDefault(); alert('Action enregistrée (mode démonstration HTML/CSS)');" action="">
                        <input type="hidden" name="action" value="add_supplier">
                        <div class="form-group">
                            <label for="nom">Nom de l'Entreprise</label>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: Comptoir Céréalier Sénégalais" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" name="telephone" class="form-control" placeholder="Ex: 338245678" required>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse / Dépôt</label>
                            <input type="text" name="adresse" class="form-control" placeholder="Ex: Hangar 4, Port de Dakar" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail (Optionnel)</label>
                            <input type="email" name="email" class="form-control" placeholder="Ex: contact@fournisseur.sn">
                        </div>
                        <button type="submit" class="btn-submit" style="width: 100%;">Créer le Fournisseur (DML)</button>
                    </form>
                </div>

                <!-- Right: Suppliers list -->
                <div class="panel-card" style="margin-bottom: 0;">
                    <label style="font-size: 13px; font-weight: 700; color: var(--accent); display: block; margin-bottom: 12px; text-transform: uppercase;">Répertoire Fournisseurs</label>
                    <table class="debt-table" id="suppliers-main-table" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Entreprise</th>
                                <th>Téléphone</th>
                                <th>Adresse</th>
                            </tr>
                        </thead>
                        <tbody>
                                                            <tr>
                                    <td style="font-weight: 700;">Comptoir Céréalier Sénégalais</td>
                                    <td>338245678</td>
                                    <td>Port de Dakar, Hangar 4</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Grossiste Diop &amp; Frères</td>
                                    <td>773456789</td>
                                    <td>Marché Grand Yoff, Lot B</td>
                                </tr>
                                                            <tr>
                                    <td style="font-weight: 700;">Sénégal Import-Export</td>
                                    <td>338211010</td>
                                    <td>Zone Industrielle de Hann</td>
                                </tr>
                                                    </tbody>
                    </table>
                </div>
            </div>
        </div>