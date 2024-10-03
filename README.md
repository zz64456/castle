# 前測實作


## SOLID
在這次 Laravel API 的實作中，我運用了 單一職責原則（SRP）、開放封閉原則（OCP）、里氏替換原則（LSP）、接口隔離原則（ISP） 和 依賴反轉原則（DIP），讓程式碼更加模塊化、可測試、易於維護和擴展。

舉例：

#### 單一職責原則
>OrderController 主要負責處理訂單相關的 API 請求，而 CurrencyOrderRepository 則負責查詢訂單數據，而AddressRepository 只負責地址的查詢。

#### 開放封閉原則
> CurrencyOrderRepository 使用了方法 getCurrencyOrderById, getTWDOrderDataById 等，這樣讓我之後只需要通過擴展 Repository 來新增不同貨幣類型的處理邏輯，而不需要修改現有的控制器。

#### 里氏替換原則
> 在我的實作中，CurrencyOrderRepository 是一個具體的類，實現了CurrencyOrderRepositoryInterface，提供了針對不同貨幣處理的邏輯。
> 將來我想要替換或擴展這個功能，只要讓新的實現遵循相同的介面 CurrencyOrderRepositoryInterface，就可以在替換原本具體的實現而不影響系統的其他部分。

#### 接口隔離原則
> 我將不同的數據邏輯分開在 CurrencyOrderRepository 和 AddressRepository 中，每個 Repository 專門負責處理相應的數據操作。這樣的設計使得每個類只需要關心與其業務邏輯相關的功能，符合接口隔離原則。

#### 依賴反轉原則
> OrderController 並不直接依賴具體的 CurrencyOrderRepository 類，而是依賴於抽象的 CurrencyOrderRepositoryInterface。控制器不需要知道具體的實現類，增加了靈活性和可測試性。

## 設計模式
關於設計模式，我理解得不夠多，這裡就先不寫上了。
但真的感謝這次的機會，讓我明白還有哪些不足可以進步！