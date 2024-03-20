        <!-- start Form -->
        <form action="">
            <div class="check_btn">
                <label>
                    <input type="radio" class="toggle-radio" name="c" value="1" id="buy" checked>
                    <div class="toggle-buy"></div>
                </label>
                <label>
                    <input type="radio" class="toggle-radio" name="c" value="2" id="rent">
                    <div class="toggle-rent"></div>
                </label>
            </div>
            <div class="search_inputs">
                <div class="input_control_search">
                    <input type="text" name="q" oninput="showSuggestions()" id="searchInput" placeholder="الحي او المنطقة">
                    <p class="no-suggestion-message" id="noSuggestionMessage"></p>
                    <ul class="suggestion-list" id="suggestionList">
                    </ul>
                    <i class='bx bx-search'></i>
                </div>
                <div class="select_type">
                    <select name="t" id="propertyTypeSelect">
                        <option value="all">نوع العقار</option>
                        <option value="1">شقة</option>
                        <option value="2">فيلا</option>
                    </select>
                </div>
                <div class="select_price">
                    <p class="price_text">السعر</p>
                    <div class="price_input">
                        <div class="input_field">
                            <div class="input_field_min">
                                <input type="number" name="pmi" placeholder="الحد الادني للسعر" id="minPriceInput">
                                <ul class="suggestion_min_price">
                                </ul>
                            </div>
                            <span>-</span>
                            <div class="input_field_max">
                                <input type="number" name="pmx" placeholder="الحد الاقصي للسعر" id="maxPriceInput">
                                <ul class="suggestion_max_price">
                                </ul>
                            </div>
                        </div>
                        <div class="rest_price_input">إعادة ضبط</div>
                    </div>
                </div>
                <div class="select_area">
                    <p class="area_text">المساحه <span>(متر مربع)</span></p>
                    <div class="area_input">
                        <div class="input_field">
                            <div class="input_field_min">
                                <input type="number" name="ami" placeholder="اقل مساحه" id="minAreaInput">
                                <ul class="suggestion_min_area">
                                </ul>
                            </div>
                            <span>-</span>
                            <div class="input_field_max">
                                <input type="number" name="amx" placeholder="اكبر مساحه" id="maxAreaInput">
                                <ul class="suggestion_max_area">
                                </ul>
                            </div>
                        </div>
                        <div class="rest_area_input">إعادة ضبط</div>
                    </div>
                </div>
                <div class="submit_btn">
                    <button type="submit" value=""><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- End Form -->