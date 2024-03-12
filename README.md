# Teste para Avaliação de Desenvolvedor Sênior: Sistema financeiro

## Descrição do Teste

**Objetivo:** Desenvolver um sistema financeiro simplificado capaz de processar operações de crédito e débito
## Requisitos Funcionais

1. **Criação de Conta:** Permitir a criação de conta com id,nome e saldo atual.
- Nessa etapa foi criado somente um endpoint simples para cadastro de pessoa

```sh
POST
http://127.0.0.1:8000/api/users
```
```sh
Payload:
{
    "name":"Sunset Client",
    "amount": "40"
}
```
Com isso é criado um usuario simples e com o valor em sua carteira.

2. **Operações de Crédito e Débito:** Suportar operações de crédito (depósitos) e débito (retiradas), atualizando o saldo das contas.
- Nessa etapa foi criado somente um endpoint simples para as transações

```sh
POST
http://127.0.0.1:8000/api/transaction
```
```sh
Payload:
{
    "type":"credit", // "debit"
    "value": 10,
    "user_id": 1
}
```
- Nessa etapa temos o tipo da transação, valor e para qual usuario vamos fazer a movimentação na carteira.

3. **Concorrência:** Garantir a capacidade de processar até 100 transações por segundo, mantendo a consistência dos dados.
- Para a questão da concorrência, foi criado um Job para aceitar todas as requisições, então conforme a transação é recebida é colocada em um Job. Além disso foi colocado tbm um Cache para evitar varias consultas ao mesmo Usuario, assim evitamos consulta desnecessaria e sobre carregar o banco de dados.

4. **Histórico de Transações:** Manter um histórico das operações realizadas para cada conta.
- Todas as transações tem o histórico, o que muda é somente a Wallet da pessoa, ela sempre é atualizada conforme a transação.

5. O saldo da conta não pode ser negativo.
- Temos uma verificação para o mesmo, evitando que a pessoa fique com saldo negativo.

## Requisitos Não Funcionais

1. **Performance:** Otimizar o sistema para alta carga de transações sem perda significativa de desempenho.
- Utilização de Filas e Cache.

2. **Segurança:** Implementar medidas de segurança para proteção das informações e transações.
- Por ser uma aplicação simples não foi implementado, mas poderiamos ter no endpoint uma Secret para o endpoint, evitando que consigam fazer transações sem ela.

3. **Testes:** Incluir testes unitários e de integração que cubram funcionalidades chave.
-

4. **Documentação:** Fornecer documentação incluindo instruções de uso e exemplos de requisições para operações.
 - Documentação essa do Readme.

## Entrega de Dados

- **Banco de Dados:** Fornecer SQL da aplicação ou usar ORM para gestão do banco de dados.
- **Esquema do Banco de Dados:** Incluir esquema do banco de dados na documentação.

> Colocado um up.sh que fara tudo de forma automatica para instalação e utilização do sistema e banco de dados.

## Tecnologias

- **Back-end:** Utilizar PHP ou Node.js.
> Utilizado: Laravel 10
- **Banco de Dados:** Escolha livre, com justificativa na documentação.
> Utilizado: Postgres

## Critérios de Avaliação

- **Arquitetura do Sistema:** Clareza e eficiência na arquitetura.
- **Qualidade do Código:** Legibilidade, manutenção, e boas práticas.
- **Performance:** Capacidade de suportar a carga de transações proposta.
- **Segurança:** Eficácia das medidas de segurança.
- **Cobertura de Testes:** Qualidade e abrangência dos testes.
- **Documentação:** Clareza e completude da documentação.

## Entrega do Teste

- O teste deve ser submetido em um repositório Git contendo código fonte, testes, e documentação.
- Deve incluir instruções para instalação, execução do sistema, e exemplos de operações de crédito e débito.

---
Video para instalação do projeto:


Video rodando os endpoints:


## Arquitetura utilizada
- No projeto foi utilizado uma pequena parte no cadastro de usuario, utilizando o Service Repository Pattern. Com isso conseguimos deixar o código mais legivel, além de conseguirmos reaproveitamento de código.
- A utilização de Cache e Job é para o sistema ficar mais eficiente e não forçar a utilização de banco de dados desnecessariamente.
- Não foi colocado nenhum função tão complexa atendendo o que foi solicitado.