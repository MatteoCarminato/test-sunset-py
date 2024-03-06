# Teste para Avaliação de Desenvolvedor Sênior: Sistema financeiro

## Descrição do Teste

**Objetivo:** Desenvolver um sistema financeiro simplificado capaz de processar operações de crédito e débito
## Requisitos Funcionais

1. **Criação de Conta:** Permitir a criação de conta com id,nome e saldo atual.
2. **Operações de Crédito e Débito:** Suportar operações de crédito (depósitos) e débito (retiradas), atualizando o saldo das contas.
3. **Concorrência:** Garantir a capacidade de processar até 100 transações por segundo, mantendo a consistência dos dados.
4. **Histórico de Transações:** Manter um histórico das operações realizadas para cada conta.
5. O saldo da conta não pode ser negativo.

## Requisitos Não Funcionais

1. **Performance:** Otimizar o sistema para alta carga de transações sem perda significativa de desempenho.
2. **Segurança:** Implementar medidas de segurança para proteção das informações e transações.
3. **Testes:** Incluir testes unitários e de integração que cubram funcionalidades chave.
4. **Documentação:** Fornecer documentação incluindo instruções de uso e exemplos de requisições para operações.

## Entrega de Dados

- **Banco de Dados:** Fornecer SQL da aplicação ou usar ORM para gestão do banco de dados.
- **Esquema do Banco de Dados:** Incluir esquema do banco de dados na documentação.

## Tecnologias

- **Back-end:** Utilizar PHP ou Node.js.
- **Banco de Dados:** Escolha livre, com justificativa na documentação.

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
- Deverá ser entregue até dia 