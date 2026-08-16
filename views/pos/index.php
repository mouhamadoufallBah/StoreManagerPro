<?php
$data = $data ?? [];
$clients = $data["clients"] ?? [];
$produits = $data["produits"] ?? [];
$cart = $data["cart"];
$ventes = $data["ventes"];

?>
<div>
    <!-- POS Stats Grid -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px;">
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--success);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">CA Encaissé Net</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;">92 000 F</div>
            </div>
            <span style="font-size: 24px;">💰</span>
        </div>
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--danger);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Encours Client Total</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;">99 000 F</div>
            </div>
            <span style="font-size: 24px;">🛑</span>
        </div>
        <div class="panel-card" style="padding: 16px; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid var(--accent);">
            <div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Commandes Enregistrées</span>
                <div style="font-size: 18px; font-weight: 800; color: white; margin-top: 4px;">4 ventes</div>
            </div>
            <span style="font-size: 24px;">📊</span>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 600px 1fr; gap: 32px; align-items: start; margin-bottom: 32px;">
        <!-- Left panel: POS ticket creator (sticky) -->
        <div class="panel-card" style="margin-bottom: 0; padding: 24px; border: 1px solid rgba(59, 130, 246, 0.2); background: linear-gradient(180deg, rgba(17, 24, 43, 0.5) 0%, rgba(10, 15, 30, 0.3) 100%); position: sticky; top: 24px;">
            <div class="panel-title" style="border-left-color: var(--accent); display: flex; justify-content: space-between; align-items: center;">
                <span>🛒 Nouvelle Vente</span>
                <span style="font-size: 11px; font-weight: 600; color: var(--text-muted); background: rgba(255,255,255,0.03); padding: 4px 8px; border-radius: 6px;">Terminal POS</span>
            </div>
            <form method="POST" action="http://localhost:8000/pos/addVente">
                <div class="form-group">
                    <label for="client_id">Client Acheteur</label>
                    <div style="position: relative;">
                        <select name="client_id" id="client-select" class="form-control" style="width: 100%; appearance: none; padding-right: 30px;" onchange="updateClientLimitInfo()">
                            <?php foreach ($clients as $client): ?>
                                <option value="<?= $client->getId() ?>" data-limit="300000"> <?= "{$client->getClientInfo()}" ?> </option>
                            <?php endforeach ?>
                        </select>
                        <span style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: var(--text-muted); font-size: 12px;">▼</span>
                    </div>
                    <span id="credit-limit-info" style="font-size:11px; color:var(--text-muted); font-weight:600; margin-top:4px; display:block;"></span>
                </div>

                <!-- Articles Dynamic add -->
                <div style="border-top: 1px dashed var(--border-color); padding-top: 16px; margin-top: 16px; margin-bottom: 16px;">
                    <label style="font-size: 12px; font-weight: 700; color: var(--accent); display: block; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Sélection des Articles</label>
                    <div style="display: grid; grid-template-columns: 2.2fr 0.8fr auto; gap: 8px; align-items: flex-end; margin-bottom: 16px;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="pos-item-select" style="font-size: 10px;">Article</label>
                            <select name="produit" id="pos-item-select" class="form-control" style="background-color: #0b0f1a; color: white; padding: 10px; font-size: 12px;">
                                <?php foreach ($produits as $produit): ?>
                                    <option value="<?= $produit->getproduitInfoForCart() ?>" data-limit="300000"> <?= "{$produit->getproduitInfo()}" ?> </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0; position: relative;">
                            <label for="pos-qty" style="font-size: 10px;">Qté</label>
                            <input type="number" name="qte" id="pos-qty" class="form-control" value="1" min="1" style="padding: 10px; font-size: 12px;">
                        </div>
                        <button type="submit" formaction="http://localhost:8000/pos/addToCart" class="btn-submit" style="height: 38px; width: 38px; font-size: 18px; display: flex; justify-content: center; align-items: center; border-radius: 8px; padding: 0; flex-shrink: 0; min-width: 38px;">+</button>
                    </div>

                    <!-- Cart Items list table -->
                    <table class="debt-table" style="font-size: 11px; margin-top: 16px;">
                        <thead>
                            <tr>
                                <th style="padding-bottom: 8px;">Produit</th>
                                <th style="padding-bottom: 8px;">Qté</th>
                                <th style="padding-bottom: 8px;">Total</th>
                                <th style="padding-bottom: 8px;"></th>
                            </tr>
                        </thead>
                        <tbody id="cart-rows">
                            <?php if (empty($cart['panier'])): ?>
                                <tr id="empty-cart-row">
                                    <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 16px 0; border-bottom: none;">Panier vide. Ajoutez des articles.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($cart['panier'] as $id => $item): ?>
                                    <?php
                                    $prixUnitaire = (float) str_replace(')', '', $item['produit']['prixUnitaire']);
                                    $qte = (int) $item['qte'];
                                    $totalLigne = $prixUnitaire * $qte;
                                    ?>
                                    <tr>
                                        <td style="padding: 8px 0; font-weight:700;"><?= htmlspecialchars($item['produit']['libelle']) ?></td>
                                        <td style="padding: 8px 0;"><?= $qte ?></td>
                                        <td style="padding: 8px 0; font-weight:800; color:var(--accent);"><?= number_format($totalLigne, 0, ',', ' ') ?> F</td>
                                        <td style="padding: 8px 0; text-align:right;">
                                            <button type="submit" formaction="http://localhost:8000/pos/removeToCart?id=<?= $item['produit']['id'] ?>" style="background:none; border:none; color:var(--danger); cursor:pointer; font-size:14px;">🗑️</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Digital Display Panel -->
                <div style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(30, 41, 59, 0.4) 100%); border: 1px solid rgba(59, 130, 246, 0.15); border-radius: 16px; padding: 14px; text-align: center; margin-bottom: 20px; box-shadow: inset 0 0 15px rgba(59, 130, 246, 0.08);">
                    <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 1px; display: block; margin-bottom: 4px;">Montant Total Net à Payer</span>
                    <div style="font-size: 24px; font-weight: 900; color: #60a5fa; letter-spacing: -0.5px; font-family: monospace; text-shadow: 0 0 10px rgba(96, 165, 250, 0.3);">
                        <span><?= $cart['montantTotal'] ?></span> <span style="font-size: 14px; font-weight: 700;">FCFA</span>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 24px;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="mode_reglement" style="font-size: 10px;">Règlement</label>
                        <select name="mode_reglement" class="form-control" style="background-color: #0b0f1a; padding: 10px; font-size: 12px;">
                            <option value="Wave">Wave</option>
                            <option value="Orange Money">OM</option>
                            <option value="Especes">Espèces</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="pos-montant-verse" style="font-size: 10px;">Versé (Avance)</label>
                        <input type="number" name="montant_verse" id="pos-montant-verse" class="form-control" value="<?= $cart['montantTotal'] ?>" min="0" style="padding: 10px; font-size: 12px;" onfocus="showKeypad('pos-montant-verse')">
                    </div>
                </div>

                <button type="submit" class="btn-submit btn-success" style="padding: 14px; font-weight: 800; font-size: 13px; width: 100%;">Valider la Vente (DML)</button>
            </form>
        </div>

        <!-- Right side: Registry logs -->
        <div class="panel-card" style="margin-bottom: 0;">
            <div class="panel-title">Registre Général des Ventes & Commandes</div>
            <table class="debt-table" id="orders-main-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Total Facture</th>
                        <th>Règlement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($ventes)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 16px 0;">Aucune vente enregistrée pour le moment.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($ventes as $vente): ?>
                            <?php
                            $uniqueId = $vente['id'];?>
                            <tr>
                                <td style="font-weight: 700; color: var(--text-muted);">#CMD-<?= $uniqueId ?></td>
                                <td style="font-weight: 700;">
                                    <?= $vente['prenom'] . ' ' . $vente['nom'] ?>
                                    <div style="font-size:11px; color:var(--text-muted); font-weight:normal;">Tél : <?= $vente['telephone'] ?></div>
                                </td>
                                <td style="font-weight: 800; color: var(--accent);"><?= $vente['montanttotal']?> F</td>
                                <td>
                                    <span class="badge"><?= $vente['statutPaiement'] . $vente['typepaiement'] ?></span>
                                </td>
                                <td>
                                    <button class="btn-quick-action" onclick="toggleDetails('order-details-<?= $uniqueId ?>')">Lignes</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="padding: 0; border: none;">
                                    <div class="details-drawer" id="order-details-<?= $uniqueId ?>">
                                        <div style="font-weight: 700; font-size: 12px; color: var(--accent); margin-bottom: 8px;">Détails Facture :</div>
                                        <table class="debt-table" style="font-size: 11px;">
                                            <thead>
                                                <tr>
                                                    <th>Produit</th>
                                                    <th>Qté</th>
                                                    <th>P.U.</th>
                                                    <th>Sous-total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($vente['lignes'])): ?>
                                                    <?php foreach ($vente['lignes'] as $ligne): ?>
                                                        <?php $sousTotal = $ligne['quantite'] * $ligne['prixunitaire']; ?>
                                                        <tr>
                                                            <td><?= $ligne['libelle'] ?></td>
                                                            <td><?= $ligne['quantite'] ?></td>
                                                            <td><?= $ligne['prixunitaire'] ?> F</td>
                                                            <td style="font-weight: 700; color: var(--accent);"><?= $sousTotal  ?> F</td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="4" style="text-align: center; color: var(--text-muted);">Aucun article pour cette commande.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>