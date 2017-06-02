package lanchonete.business;

import lanchonete.DAO.PedidoDao;
import lanchonete.model.PedidoModel;

public class PedidoService {
	PedidoDao dao = new PedidoDao();
	
	public PedidoModel buscarPedidos(int codPedido) {
		PedidoModel pedido = new PedidoModel();
		try {
			pedido = dao.getPedido(codPedido);
		} catch (Exception e) {
			e.printStackTrace();
		}
		return pedido;
	}
	
}
